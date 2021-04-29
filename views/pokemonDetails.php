<?php

include("../Controllers/PokemonController.php");


if (!isset($_SESSION["logedIn"])) {
    session_start();
}

if ($_SESSION["logedIn"] != 1 || $_SESSION["permission_lvl"] < 500) {
    header("location: myPokemons.php");
}



$prevLoc = "allPokemons.php";
if (isset($_SERVER['HTTP_REFERER'])) {
    $prevLoc = $_SERVER['HTTP_REFERER'];
}

if (isset($_POST["delete"])) {
    deletePokemon($_POST["id_to_delete"]);
    header("location: allPokemons.php");
}


if (isset($_GET["id"])) {
    $pokemon = getPokemonById($_GET["id"]);
    $usersOwning = getPokemonOwningUsers($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>

    <section class="container grey-text centered">
        <div class="pokemon-img">
            <div class="image">
                <img src="https://assets.thesilphroad.com/img/pokemon/icons/96x96/<?php echo $pokemon->getId() ?>.png" alt="pokemon">
            </div>
        </div>

        <form method="POST" action="pokemonDetails.php">
            <table class="striped">
                <tbody>
                    <tr>
                        <td> ID </td>
                        <td> <?php echo $pokemon->getId() ?> </td>
                    </tr>
                    <tr>
                        <td> Name </td>
                        <td> <?php echo $pokemon->getName() ?> </td>
                    </tr>
                    <tr>
                        <td> Max Attack </td>
                        <td> <?php echo $pokemon->getMaxAttack() ?> </td>
                    </tr>
                    <tr>
                        <td> Max Defence </td>
                        <td> <?php echo $pokemon->getMaxDefence() ?> </td>
                    </tr>
                    <tr>
                        <td> Max Stamina </td>
                        <td> <?php echo $pokemon->getMaxStamina() ?> </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id_to_delete" value=" <?php echo $pokemon->getId() ?> ">
                        <td><input type="submit" name="delete" value="Delete Pokemon" class="btn red z-depth-0"></td>
                        <td><a href="pokemonDatabase.php" class="btn z-depth-0" </a>All Pokemons</td>
                    </tr>
                </tbody>
            </table>
        </form>

        <form method="GET" action="pokemonDetails.php">
            <table class="striped users">

                <thead>
                    <th> Users owning this Pokemon </th>
                </thead>
                <tbody>
                    <?php foreach ($usersOwning as $user) { ?>

                        <tr class="user-details">
                            <td> <a href="userDetails.php?id=<?php echo $user["id"] ?>"> <?php echo $user["email"] ?></a> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>


    </section>


</main>

<?php include("templates/footer.php") ?>