<?php


include("../Controllers/UserController.php");

if (!isset($_SESSION["logedIn"])) {
    session_start();
}

$_SESSION["count"]++;

if ($_SESSION["logedIn"] != 1) {
    header("location: login.php");
}
if ($_SESSION["count"] < 2) {
    $welcomeMessage = 'Hello ' . $_SESSION["name"] . " ". $_SESSION["surname"] ."!";
} else {
    $welcomeMessage = "";
}

$userPokemons = getUserPokemons($_SESSION["id"]); // array of pokemon IDs

?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>
    <section class="container grey-text">
        <h5 class="center grey-text" style="padding-top: 40px;"><?php echo $welcomeMessage ?></h5>
        <h5 class="center grey-text" style="padding-bottom: 20px;"> Your owned Pokemons </h5>

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