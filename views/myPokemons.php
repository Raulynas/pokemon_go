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
    $welcomeMessage = 'Hello ' . $_SESSION["name"] . " " . $_SESSION["surname"] . "!";
} else {
    $welcomeMessage = "";
}

$userPokemons = getUserPokemons($_SESSION["id"]);

$_SESSION["numberOfPokemons"] = count($userPokemons);

?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>
    <section class="container grey-text">
        <h5 class="center grey-text" style="padding-top: 40px;"><?php echo $welcomeMessage ?></h5>
        <?php if ($_SESSION["numberOfPokemons"] == 0) { ?>
            <h5 class="center grey-text" style="padding-bottom: 20px;"> Your have no Pokemons yet :( </h5>
        <?php } ?>
        <?php if ($_SESSION["numberOfPokemons"] == 1) { ?>
            <h5 class="center grey-text" style="padding-bottom: 20px;"> Your have one pokemon </h5>
        <?php } ?>
        <?php if ($_SESSION["numberOfPokemons"] > 1) { ?>
            <h5 class="center grey-text" style="padding-bottom: 20px;"> Your have <?php echo $_SESSION["numberOfPokemons"] ?> Pokemons </h5>
        <?php } ?>

        <container class="cards">

            <?php
            foreach ($userPokemons as $pokemon) { ?>

                <div class="card">
                    <div class="card-image">
                        <img src="https://assets.thesilphroad.com/img/pokemon/icons/96x96/<?php echo $pokemon->getId() ?>.png" alt="pokemon">
                    </div>
                    <div class="card-content">
                        <span class="card-title grey-text text-darken-4 center-align"><?php echo $pokemon->getName() ?></span>

                        <div class="description grey-text">
                            <div class="left-box">Attack: <?php echo $pokemon->getMaxAttack() ?></div>
                            <div class="progress-background">
                                <div class="progr1" style="width: <?php echo $pokemon->getMaxAttack() ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Defence: <?php echo $pokemon->getMaxDefence() ?></div>
                            <div class="progress-background">
                                <div class="progr1" style="width: <?php echo $pokemon->getMaxDefence() ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Stamina: <?php echo $pokemon->getMaxStamina() ?></div>
                            <div class="progress-background">
                                <div class="progr1" style="width: <?php echo $pokemon->getMaxStamina() ?>%;"></div>
                            </div>
                        </div>


                    </div>
                    <div class="card-action" style="margin: 0;">
                    </div>


                </div>
            <?php
            }
            ?>

        </container>
    </section>


</main>

<?php include("templates/footer.php") ?>