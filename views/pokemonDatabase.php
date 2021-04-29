<?php


include("../Controllers/PokemonController.php");

if (!isset($_SESSION["logedIn"])) {
    session_start();
}

$_SESSION["count"]++;

if ($_SESSION["logedIn"] != 1 || $_SESSION["permission_lvl"] < 500) {
    header("location: myPokemons.php");
}

$pokemons = getAllPokemons();


if (isset($_GET["id"])) {
    $pokemons = getAllPokemonsById($_GET['order']);
}

if (isset($_GET["name"])) {
    $pokemons = getAllPokemonsByName($_GET['order']);
}
if (isset($_GET["attack"])) {
    $pokemons = getAllPokemonsByAttack($_GET['order']);
}
if (isset($_GET["defence"])) {
    $pokemons = getAllPokemonsByDefence($_GET['order']);
}
if (isset($_GET["stamina"])) {
    $pokemons = getAllPokemonsByStamina($_GET['order']);
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php") ?>

<main>
    <section class="container grey-text centered">
        <form method="GET" action="" class="pokemon-form">
            <table class="highlight centered">
                <thead>
                    <tr>
                        <th><a href="pokemonDatabase.php?id&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">ID</a></th>
                        <th><a href="pokemonDatabase.php?name&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Name</a></th>
                        <th><a href="pokemonDatabase.php?attack&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Max Attack</a></th>
                        <th><a href="pokemonDatabase.php?defence&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Max Defence</a></th>
                        <th><a href="pokemonDatabase.php?stamina&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Max Stamina</a></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($pokemons as $pokemon) { ?>

                        <tr>
                            <td> <a href="pokemonDetails.php?id=<?php echo $pokemon->getId() ?>"> <?php echo $pokemon->getId() ?></a></td>
                            <td> <a href="pokemonDetails.php?id=<?php echo $pokemon->getId() ?>"> <?php echo $pokemon->getName() ?></a></td>
                            <td> <a href="pokemonDetails.php?id=<?php echo $pokemon->getId() ?>"> <?php echo $pokemon->getMaxAttack() ?></a></td>
                            <td> <a href="pokemonDetails.php?id=<?php echo $pokemon->getId() ?>"> <?php echo $pokemon->getMaxDefence() ?></a> </td>
                            <td> <a href="pokemonDetails.php?id=<?php echo $pokemon->getId() ?>"> <?php echo $pokemon->getMaxStamina() ?></a> </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </form>

    </section>


</main>

<?php include("templates/footer.php") ?>