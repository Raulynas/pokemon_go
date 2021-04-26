<?php

include("../Controllers/UserController.php");


if (!isset($_SESSION["logedIn"])) {
    session_start();
}

if ($_SESSION["logedIn"] != 1) {
    header("location: login.php");
}


if (isset($_POST["delete"])) {
    deleteUser($_POST["id_to_delete"]);
    header("location: allusers.php");
}


$user = getUserById($_GET["id"]);

if (isset($_GET["id"])) {
}



?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>
    <section class="container grey-text centered">
        <form method="POST" action="userDetails.php">
            <table class="striped">
                <tbody>
                    <tr>
                        <td> ID </td>
                        <td> <?php echo $user->getId() ?> </td>
                    </tr>
                    <tr>
                        <td> Name </td>
                        <td> <?php echo $user->getName() . " " . $user->getSurname() ?> </td>
                    </tr>
                    <tr>
                        <td> Email address </td>
                        <td> <?php echo $user->getEmail() ?> </td>
                    </tr>
                    <tr>
                        <td> Permission level </td>
                        <td> <?php echo $user->getPermission_lvl() ?> </td>
                    </tr>
                    <tr>
                        <td> Owned Pokemons </td>
                        <td> <?php echo count(($user->getOwnedPokemons())) ?> </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id_to_delete" value=" <?php echo $user->getId() ?> ">
                        <td><input type="submit" name="delete" value="Delete User" class="btn red z-depth-0"></td>
                        <td><a href="allUsers.php" class="btn z-depth-0"</a>Back to all users</td>
                    </tr>


                </tbody>
            </table>

        </form>

    </section>


</main>

<?php include("templates/footer.php") ?>