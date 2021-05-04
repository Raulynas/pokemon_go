<?php
if (!isset($_SESSION["logedIn"])) {
    session_start();
    $_SESSION["logedIn"] = 0;
}

$home = '<li><a href="../views/index.php">Home</a></li>';
$allPokemons = '<li><a href="../views/allPokemons.php">All Pokemons</a></li>';
$userhome = '<li><a href="../views/myPokemons.php">My Pokemons</a></li>';
$catchPokemon = '<li><a href="../views/catchPokemon.php">Play</a></li>';
$addPokemon = '<li><a href="../views/addPokemon.php">Add Pokemon</a></li>';
$allUsers = '<li><a href="../views/allUsers.php">All Users</a></li>';
$pokemonDatabase = '<li><a href="../views/pokemonDatabase.php">Pokemon database</a></li>';
$login = '<li><a href="../views/login.php">Log in</a></li>';
$logout = '<li><a href="../views/login.php">Logout</a></li>';
$signup = '<li><a href="../views/signup.php">Sign up</a></li>';

$headerNav = $home . $login . $signup;
if ($_SESSION["logedIn"] == 1) $headerNav = $userhome . $catchPokemon . $allPokemons . $logout;
if ($_SESSION["logedIn"] == 1 && $_SESSION["permission_lvl"] > 500) $headerNav = $userhome . $allPokemons . $catchPokemon . $allUsers . $addPokemon . $pokemonDatabase . $logout


?>


<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../public/css/materialize.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pokemon GO</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <link rel="stylesheet" href="../public/css/main.css">


</head>


<body class="grey lighten-4">
    <header class="header">
        <nav>
            <div class="nav-wrapper">
                <a href="../index.php" class="brand-logo center">Pokemon GO</a>
                <a href="#" data-target="mobile-links" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul class="right hide-on-med-and-down">
                    <?php echo $headerNav ?>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-links">
        <!-- event listener in footer -->
            <?php echo $headerNav ?>
        </ul>


    </header>