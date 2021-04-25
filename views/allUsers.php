<?php


include("../Controllers/UserController.php");

if (!isset($_SESSION["logedIn"])) {
    session_start();
}

$_SESSION["count"]++;

if ($_SESSION["logedIn"] != 1) {
    header("location: login.php");
}

$users = getAllUsersById();

if (isset($_GET["id"])) {
    $users = getAllUsersById();
}

if (isset($_GET["name"])) {
    $users = getAllUsersByName();
}
if (isset($_GET["surname"])) {
    $users = getAllUsersBySurname();
}
if (isset($_GET["email"])) {
    $users = getAllUsersByEmail();
}
if (isset($_GET["level"])) {
    $users = getAllUsersByLevel();
}
if (isset($_GET["pokemons"])) {
    $users = getAllUsersByPokemons();
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>
    <section class="container grey-text centered">
        <form class="users-form" method="GET" action="allUsers.php">
            <table class="highlight centered">
                <thead>
                    <tr>
                        <th><a href="allUsers.php?id">ID</a></th>
                        <th><a href="allUsers.php?name">Name</a></th>
                        <th><a href="allUsers.php?surname">Surname</a></th>
                        <th><a href="allUsers.php?email">Email</a></th>
                        <th><a href="allUsers.php?level">Level</a></th>
                        <th><a href="allUsers.php?pokemons">Pokemons</a></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>




                    <?php
                    foreach ($users as $user) { ?>

                        <tr>
                            <td> <?php echo $user->getId() ?> </td>
                            <td> <?php echo $user->getName() ?> </td>
                            <td> <?php echo $user->getSurname() ?> </td>
                            <td> <?php echo $user->getEmail() ?> </td>
                            <td> <?php echo $user->getPermission_lvl() ?> </td>
                            <td>
                                <a href="">
                                    <?php echo count(($user->getOwnedPokemons())) ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </form>

    </section>


</main>

<?php include("templates/footer.php") ?>