<?php
if (!isset($_SESSION["logedIn"])) {
    session_start();
}
if ($_SESSION["logedIn"] != 1 || $_SESSION["permission_lvl"] < 500) {
    header("location: myPokemons.php");
}

include("../Controllers/PokemonController.php");

$name = "";
$maxAttack = "";
$maxDefence = "";
$maxStamina = "";

$errors = ["name" => "", "maxAttack" => "", "maxDefence" => "", "maxStamina" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //name validation
    if (empty($_POST["name"])) {
        $errors["name"] = "Pokemon's name must not be empty";
    } else {
        $name = $_POST["name"];
        if (!preg_match("/^[a-zA-Z]+$/", $name))
            $errors["name"] = "Pokemon's name must be letters only";
    }
    // maxAttack validation
    if (empty($_POST["maxAttack"])) {
        $errors["maxAttack"] = "Max Attack must not be empty";
    } else {
        $maxAttack = $_POST["maxAttack"];
        if ($maxAttack < 0 || $maxAttack > 100)
            $errors["maxAttack"] = "Must be number between 0 and 100";
    }

    // maxDefence validation
    if (empty($_POST["maxDefence"])) {
        $errors["maxDefence"] = "Max Defence must not be empty";
    } else {
        $maxDefence = $_POST["maxDefence"];
        if ($maxDefence < 0 || $maxDefence > 100)
            $errors["maxDefence"] = "Must be number between 0 and 100";
    }

    // maxStamina validation
    if (empty($_POST["maxStamina"])) {
        $errors["maxStamina"] = "Max Stamina must not be empty";
    } else {
        $maxStamina = $_POST["maxStamina"];
        if ($maxStamina < 0 || $maxStamina > 100)
            $errors["maxStamina"] = "Must be number between 0 and 100";
    }





    if (array_filter($errors)) {
        // echo "errors in the form";
    } else {
        store($_POST);

        // to generate lot of pokemons
        // generatePokemons(); 

    }
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>
    <section class="container grey-text">
        <h5 class="center">Add new Pokemon</h5>
        <form action="addPokemon.php" class="white" method="POST">

            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>" placeholder="Name">
            <div class="red-text"><?php echo $errors["name"] ?></div>

            <input type="number" name="maxAttack" value="<?php echo htmlspecialchars($maxAttack) ?>" placeholder="Max Attack [ 0 - 100 ]">
            <div class="red-text"><?php echo $errors["maxAttack"] ?></div>

            <input type="number" name="maxDefence" value="<?php echo htmlspecialchars($maxDefence) ?>" placeholder="Max Defence [ 0 - 100 ]">
            <div class="red-text"><?php echo $errors["maxDefence"] ?></div>

            <input type="number" name="maxStamina" value="<?php echo htmlspecialchars($maxStamina) ?>" placeholder="Max Stamina [ 0 - 100 ]">
            <div class="red-text"><?php echo $errors["maxStamina"] ?></div>

            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>

        </form>
    </section>
</main>

<?php include("templates/footer.php") ?>