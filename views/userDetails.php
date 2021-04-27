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
$userPokemons = getUserPokemons($_GET["id"]); // array of pokemon IDs


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
                        <td> <?php echo count(getUserPokemons($user->getId())) ?> </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id_to_delete" value=" <?php echo $user->getId() ?> ">
                        <td><input type="submit" name="delete" value="Delete User" class="btn red z-depth-0"></td>
                        <td><a href="allUsers.php" class="btn z-depth-0" </a>Back to all users</td>
                    </tr>


                </tbody>
            </table>

        </form>


        <container class="cards">

            <?php
            foreach ($userPokemons as $id) { ?>

                <div class="card">
                    <div class="card-image">
                        <img src="https://assets.thesilphroad.com/img/pokemon/icons/96x96/<?php echo getPokemonById($id)->getId() ?>.png" alt="pokemon">
                    </div>
                    <div class="card-content">
                        <span class="card-title grey-text text-darken-4 center-align"><?php echo getPokemonById($id)->getName() ?></span>

                        <div class="description grey-text">
                            <div class="left-box">Max attack: <?php echo getPokemonById($id)->getMaxAttack() ?></div>
                            <div class="progress-background">
                                <div class="progr" style="width: <?php echo getPokemonById($id)->getMaxAttack() ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Max defence: <?php echo getPokemonById($id)->getMaxDefence() ?></div>
                            <div class="progress-background">
                                <div class="progr" style="width: <?php echo getPokemonById($id)->getMaxDefence() ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Max stamina: <?php echo getPokemonById($id)->getMaxStamina() ?></div>
                            <div class="progress-background">
                                <div class="progr" style="width: <?php echo getPokemonById($id)->getMaxStamina() ?>%;"></div>
                            </div>
                        </div>


                    </div>

                </div>
            <?php
            }
            ?>

        </container>


    </section>


</main>

<?php include("templates/footer.php") ?>