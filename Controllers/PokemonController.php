<?php
include("../Models/Pokemon.php");


function store($request)
{
    $pokemon = new Pokemon(NULL, $request["name"], $request["maxAttack"], $request["maxDefence"], $request["maxStamina"]);
    $pokemon->save();
    header("Location:../views/addPokemon.php");
}


function generatePokemons()
{
    $names = ["Bulbasaur", "Ivysaur", "Venusaur", "Charmander", "Charmeleon", "Charizard", "Squirtle", "Wartortle", "Blastoise", "Caterpie", "Metapod", "Butterfree", "Weedle", "Kakuna", "Beedrill", "Pidgey", "Pidgeotto", "Pidgeot", "Rattata", "Raticate", "Spearow", "Fearow", "Ekans", "Arbok", "Pikachu", "Raichu", "Sandshrew", "Sandslash", "Nidoran", "Nidorina", "Nidoqueen", "Nidoran", "Nidorino", "Nidoking", "Clefairy", "Clefable", "Vulpix", "Ninetales", "Jigglypuff", "Wigglytuff", "Zubat", "Golbat", "Oddish", "Gloom", "Vileplume", "Paras", "Parasect", "Venonat", "Venomoth", "Diglett", "Dugtrio", "Meowth", "Persian", "Psyduck", "Golduck", "Mankey", "Primeape", "Growlithe", "Arcanine", "Poliwag", "Poliwhirl", "Poliwrath", "Abra", "Kadabra", "Alakazam", "Machop", "Machoke", "Machamp", "Bellsprout", "Weepinbell", "Victreebel", "Tentacool", "Tentacruel", "Geodude", "Graveler", "Golem", "Ponyta", "Rapidash", "Slowpoke", "Slowbro", "Magnemite", "Magneton", "Farfetch'd", "Doduo", "Dodrio", "Seel", "Dewgong", "Grimer", "Muk", "Shellder", "Cloyster", "Gastly", "Haunter", "Gengar", "Onix", "Drowzee", "Hypno", "Krabby", "Kingler", "Voltorb", "Electrode", "Exeggcute", "Exeggutor", "Cubone", "Marowak", "Hitmonlee", "Hitmonchan", "Lickitung", "Koffing", "Weezing", "Rhyhorn", "Rhydon", "Chansey", "Tangela", "Kangaskhan", "Horsea", "Seadra", "Goldeen", "Seaking", "Staryu", "Starmie", "Mr. Mime", "Scyther", "Jynx", "Electabuzz", "Magmar", "Pinsir", "Tauros", "Magikarp", "Gyarados", "Lapras", "Ditto", "Eevee", "Vaporeon", "Jolteon", "Flareon", "Porygon", "Omanyte", "Omastar", "Kabuto", "Kabutops", "Aerodactyl", "Snorlax", "Articuno", "Zapdos", "Moltres", "Dratini", "Dragonair", "Dragonite", "Mewtwo", "Mew"];
    
    foreach ($names as $name) {
        $maxAttack = rand(0, 100);
        $maxDefence = rand(0, 100);
        $maxStamina = rand(0, 100);
        
        $dbh = new Dbh();
        $sql =
        "INSERT INTO `pokemons` (`id`, `name`, `max_attack`, `max_defence`, `max_stamina`)
        VALUES (NULL, '" . $name . "', '" . $maxAttack . "', '$maxDefence', '$maxStamina')";
        $dbh->connect()->query($sql);
    }

}


    function getAllPokemonsById()
    {
        return Pokemon::getAllPokemonsById();
    }
    function getAllPokemonsByName()
    {
        return Pokemon::getAllPokemonsByName();
    }
    function getAllPokemonsByAttack()
    {
        return Pokemon::getAllPokemonsByAttack();
    }
    function getAllPokemonsByDefence()
    {
        return Pokemon::getAllPokemonsByDefence();
    }
    function getAllPokemonsByStamina()
    {
        return Pokemon::getAllPokemonsByStamina();
    }















