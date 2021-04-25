<?php
if (!isset($_SESSION["logedIn"])) {
    session_start();
    $_SESSION["logedIn"] = 0;
}

$home = '<li><a href="../views/index.php">Home</a></li>';
$catchPokemon = '<li><a href="../views/catchPokemon.php">Catch Pokemon</a></li>';
$userhome = '<li><a href="../views/myPokemons.php">My Pokemons</a></li>';
$addPokemon = '<li><a href="../views/addPokemon.php">Add Pokemon</a></li>';
$allUsers = '<li><a href="../views/allUsers.php">All Users</a></li>';
$allPokemons = '<li><a href="../views/allPokemons.php">All Pokemons</a></li>';
$login = '<li><a href="../views/login.php">Log in</a></li>';
$logout = '<li><a href="../views/login.php">Logout</a></li>';
$signup = '<li><a href="../views/signup.php">Sign up</a></li>';
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
    <link rel="stylesheet" href="http://localhost/backEnd/pokemon_go/public/css/main.css">

</head>


<body class="grey lighten-4">
    <header class="header">
        <nav>
            <div class="nav-wrapper">
                <a href="../index.php" class="brand-logo center">Pokemon GO</a>
                <ul class="right hide-on-med-and-down">
                    <?php if ($_SESSION["logedIn"] == 0) echo $home ?>
                    <?php if ($_SESSION["logedIn"] == 0) echo $login ?>
                    <?php if ($_SESSION["logedIn"] == 0) echo $signup ?>

                    <?php if ($_SESSION["logedIn"] == 1) echo $userhome ?>
                    <?php if ($_SESSION["logedIn"] == 1) echo $catchPokemon ?>
                    <?php if ($_SESSION["logedIn"] == 1) echo $addPokemon ?>
                    <?php if ($_SESSION["logedIn"] == 1) echo $allUsers ?>
                    <?php if ($_SESSION["logedIn"] == 1) echo $allPokemons ?>
                    <?php if ($_SESSION["logedIn"] == 1) echo $logout ?>
                </ul>
            </div>
        </nav>

    </header>

