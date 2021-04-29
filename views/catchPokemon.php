<?php

include("../Controllers/PokemonController.php");

if (!isset($_SESSION["logedIn"])) {
    session_start();
}

if ($_SESSION["logedIn"] != 1) {
    header("location: login.php");
}


if ($_SERVER["REQUEST_METHOD"] == "GET" || $_SESSION["pokemonCought"] == 1) {
    unset($_POST["catch"]);
    $_SESSION["attempts"] = rand(1, 7);
    $_SESSION["pokemonCought"] = 0;

    $allPokemons = getAllPokemons();

    $randPokemon = $allPokemons[rand(0, count($allPokemons))];
    $pokemonToCatch = new Pokemon($randPokemon->getId(), $randPokemon->getName(), NULL, NULL, NULL);

    $_SESSION["pokemon_id"] = $randPokemon->getId();
    $_SESSION["pokemon_name"] = $randPokemon->getName();
    $_SESSION["max_attack"] = $randPokemon->getMaxAttack();
    $_SESSION["max_defence"] = $randPokemon->getMaxDefence();
    $_SESSION["max_stamina"] = $randPokemon->getMaxStamina();

    $_SESSION["attack"] = rand(0, $randPokemon->getMaxAttack());
    $_SESSION["defence"] = rand(0, $randPokemon->getMaxDefence());
    $_SESSION["stamina"] = rand(0, $randPokemon->getMaxStamina());
}

$probabilityToCatch = round(20 + $_SESSION["numberOfPokemons"] / 10);


if (isset($_POST["catch"])) {
    $_SESSION["attempts"]--;
    if (rand(0, 100) <= $probabilityToCatch) {
        $_SESSION["pokemonCought"] = 1;
    }
}

if ($_SESSION["pokemonCought"] != 1) {

    if ($_SESSION["attempts"] < 1) {
        $msg = "Sorry, better luck next time :(";
        $submitButton = '<input type="submit" name="try_again" class="btn" value="Try again" style="background-color: green;">';
    } else {
        $msg = 'Total attempts: ' . $_SESSION["attempts"] . "<br> you have probability to catch: " . $probabilityToCatch . "%";
        $submitButton = '<input type="submit" name="catch" class="btn" value="Catch!">';
    }
}
$msg2 = "";
if($_SESSION["attempts"] > 0 && $_SESSION["pokemonCought"] != 1 && isset($_POST["catch"])){
    $msg2 = "Missed!";
}

if ($_SESSION["pokemonCought"] == 1) {
    $msg = "Congratulations!! You cought the " . $_SESSION['pokemon_name'] . "!";
    addPokemonToUser($_SESSION["id"], $_SESSION["pokemon_id"], $_SESSION["attack"], $_SESSION["defence"], $_SESSION["stamina"],);
    $submitButton = '<input type="submit" name="go_home" class="btn" value="Back Home" ;">';
}
if (isset($_POST["go_home"])) {
    header("Location: myPokemons.php");
}
if (isset($_POST["try_again"])) {
    header("Location: catchPokemon.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>
    <section class="container grey-text">
        <h5 class="center grey-text" style="padding-bottom: 20px;"><?php echo $msg ?></h5>
        <form action="catchPokemon.php" method="POST">

            <container class="cards">

                <div class="card">
                    <div class="card-image">
                        <img src="https://assets.thesilphroad.com/img/pokemon/icons/96x96/<?php echo $_SESSION["pokemon_id"] ?>.png" alt="pokemon">
                    </div>
                    <div class="card-content">
                        <span class="card-title grey-text text-darken-4 center-align"><?php echo $_SESSION["pokemon_name"] ?></span>

                        <div class="description grey-text">
                            <div class="left-box">Attack: <?php echo $_SESSION["attack"] ?></div>
                            <div class="progress-background">
                                <div class="progr1" style="width: <?php echo $_SESSION["attack"] ?>%;"></div>
                                <div class="progr2" style="width: <?php echo $_SESSION["max_attack"] ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Defence: <?php echo $_SESSION["defence"] ?></div>
                            <div class="progress-background">
                                <div class="progr1" style="width: <?php echo $_SESSION["defence"] ?>%;"></div>
                                <div class="progr2" style="width: <?php echo $_SESSION["max_defence"] ?>%;"></div>
                            </div>
                        </div>
                        <div class="description grey-text">
                            <div class="left-box">Stamina: <?php echo $_SESSION["stamina"] ?></div>
                            <div class="progress-background">
                                <div class="progr1" style="width: <?php echo $_SESSION["stamina"] ?>%;"></div>
                                <div class="progr2" style="width: <?php echo $_SESSION["max_stamina"] ?>%;"></div>
                            </div>
                        </div>


                    </div>
                    <div class="card-action" style="margin: 0;">
                        <?php echo $submitButton ?>
                    </div>

                </div>

            </container>
        </form>
        <h5 class="center grey-text" style="padding-bottom: 20px;"><?php echo $msg2 ?></h5>

    </section>


</main>

<?php include("templates/footer.php") ?>