<?php

include("../Models/User.php");

function register($request)
{
    $user = new User(NULL, $request["name"], $request["surname"], $request["email"], sha1($request["password1"]), $request["ownedPokemons"] ,$request["permission_lvl"]);
    $user->save();
}

function login($request)
{
    $setPassword = "";
    $dbh = new Dbh();
    $sql = "SELECT * from `users` where email ='" . $request['email'] . "'";
    $result =  $dbh->connect()->query($sql);
    while ($row = $result->fetch_assoc()) {
        $setPassword = $row["password"];
    }
    return $setPassword == sha1($request["password"]) ? 1 : 0;
}

function getUserName($request)
{
    $dbh = new Dbh();
    $sql = "SELECT * from `users` where email ='" . $request['email'] . "'";
    $result =  $dbh->connect()->query($sql);
    while ($row = $result->fetch_assoc()) {
        return $row["name"];
    }
}
function getUserSurname($request)
{
    $dbh = new Dbh();
    $sql = "SELECT * from `users` where email ='" . $request['email'] . "'";
    $result =  $dbh->connect()->query($sql);
    while ($row = $result->fetch_assoc()) {
        return $row["surname"];
    }
}
function getAllUserPokemons($request)
{
    return User::getAllUserPokemons($request);
}
function getPokemonById($request)
{
    return User::getPokemonById($request);
}





function getAllUsersById()
{
    return User::getAllUsersById();
}
function getAllUsersByName()
{
    return User::getAllUsersByName();
}
function getAllUsersBySurname()
{
    return User::getAllUsersBySurname();
}
function getAllUsersByEmail()
{
    return User::getAllUsersByEmail();
}
function getAllUsersByLevel()
{
    return User::getAllUsersByLevel();
}
function getAllUsersByPokemons()
{
    return User::getAllUsersByPokemons();
}

