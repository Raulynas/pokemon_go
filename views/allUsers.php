<?php


include("../Controllers/UserController.php");

if (!isset($_SESSION["logedIn"])) {
    session_start();
}

$_SESSION["count"]++;

if ($_SESSION["logedIn"] != 1 || $_SESSION["permission_lvl"] < 500) {
    header("location: myPokemons.php");
}

$users = getAllUsers();

if (isset($_GET["id"])) {
    $users = getAllUsersSorted("user_id", $_GET['order']);
}

if (isset($_GET["name"])) {
    $users = getAllUsersSorted("user_name", $_GET['order']);
}
if (isset($_GET["surname"])) {
    $users = getAllUsersSorted("surname", $_GET['order']);
}
if (isset($_GET["email"])) {
    $users = getAllUsersSorted("email", $_GET['order']);
}
if (isset($_GET["level"])) {
    $users = getAllUsersSorted("permission_lvl", $_GET['order']);
}
if (isset($_GET["pokemons"])) {
    $users = getAllUsersSorted("number_of_pokemons", $_GET['order']);
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
                        <th><a href="allUsers.php?id&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">ID</a></th>
                        <th><a href="allUsers.php?name&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Name</a></th>
                        <th><a href="allUsers.php?surname&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Surname</a></th>
                        <th><a href="allUsers.php?email&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Email</a></th>
                        <th><a href="allUsers.php?level&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Level</a></th>
                        <th><a href="allUsers.php?pokemons&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Pokemons</a></th>
                        <th></th>

                    </tr>
                </thead>

                <tbody>




                    <?php
                    foreach ($users as $user) { ?>

                        <tr class="user-details">
                            <td> <a href="userDetails.php?id=<?php echo $user->getId() ?>"> <?php echo $user->getId() ?></a> </td>
                            <td> <a href="userDetails.php?id=<?php echo $user->getId() ?>"><?php echo $user->getName() ?> </a></td>
                            <td> <a href="userDetails.php?id=<?php echo $user->getId() ?>"><?php echo $user->getSurname() ?> </a></td>
                            <td><a href="userDetails.php?id=<?php echo $user->getId() ?>"> <?php echo $user->getEmail() ?> </a></td>
                            <td><a href="userDetails.php?id=<?php echo $user->getId() ?>"> <?php echo $user->getPermission_lvl() ?> </a></td>
                            <td><a href="userDetails.php?id=<?php echo $user->getId() ?>"> <?php echo count(getUserPokemons($user->getId())) ?> </a></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </form>

    </section>


</main>

<?php include("templates/footer.php") ?>