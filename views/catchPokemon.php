<?php

include("../Controllers/PokemonController.php");

if (!isset($_SESSION["logedIn"])) {
    session_start();
}

if ($_SESSION["logedIn"] != 1) {
    header("location: login.php");
}

$pokemons = getAllPokemonsByName();

?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>
<main>

    <section class="container grey-text">
        <h5 class="center grey-text" style="padding: 50px 0;">Catch your Pokemon</h5>
        <container class="cards">

            <?php
            foreach ($pokemons as $value) { ?>

                <div class="card">
                    <div class="card-image">
                        <img src="https://assets.thesilphroad.com/img/pokemon/icons/96x96/<?php echo $value->getId() ?>.png" alt="pokemon">
                    </div>
                    <div class="card-content">
                        <span class="card-title grey-text text-darken-4 center-align"><?php echo $value->getName() ?></span>

                        <div class="description grey-text">
                            <div class="left-box">Max attack: <?php echo $value->getMaxAttack() ?></div>
                            <div class="progress-background">
                                <div class="progr" style="width: <?php echo $value->getMaxAttack() ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Max defence: <?php echo $value->getMaxDefence() ?></div>
                            <div class="progress-background">
                                <div class="progr" style="width: <?php echo $value->getMaxDefence() ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Max stamina: <?php echo $value->getMaxStamina() ?></div>
                            <div class="progress-background">
                                <div class="progr" style="width: <?php echo $value->getMaxStamina() ?>%;"></div>
                            </div>
                        </div>


                    </div>

                    <div class="card-action" style="margin: 0;">
                        <a style="margin: 0;" href=" #">catch</a>
                    </div>
                </div>
            <?php
            }
            ?>

        </container>


    </section>

</main>

<?php include("templates/footer.php") ?>

