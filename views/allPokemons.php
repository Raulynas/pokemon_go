<?php


include("../Controllers/PokemonController.php");

if (!isset($_SESSION["logedIn"])) {
    session_start();
}

$_SESSION["count"]++;

if ($_SESSION["logedIn"] != 1) {
    header("location: login.php");
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
                        <th><a href="allPokemons.php?id&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">ID</a></th>
                        <th><a href="allPokemons.php?name&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Name</a></th>
                        <th><a href="allPokemons.php?attack&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Max Attack</a></th>
                        <th><a href="allPokemons.php?defence&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Max Defence</a></th>
                        <th><a href="allPokemons.php?stamina&order=<?php echo isset($_GET['order']) ? !$_GET['order'] : 1; ?>">Max Stamina</a></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($pokemons as $pokemon) { ?>

                        <tr>
                            <td> <?php echo $pokemon->getId() ?> </td>
                            <td> <?php echo $pokemon->getName() ?> </td>
                            <td> <?php echo $pokemon->getMaxAttack() ?> </td>
                            <td> <?php echo $pokemon->getMaxDefence() ?> </td>
                            <td> <?php echo $pokemon->getMaxStamina() ?> </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </form>

    </section>


</main>

<?php include("templates/footer.php") ?>