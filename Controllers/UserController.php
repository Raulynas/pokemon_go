<?php

include("../Models/User.php");

function register($request)
{
    $user = new User(NULL, $request["name"], $request["surname"], $request["email"], sha1($request["password1"]), $request["ownedPokemons"], $request["permission_lvl"]);
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





function getUserById($request)
{
    return User::getUserById($request);
}
function getAllUsers()
{
    return User::getAllUsers();
}
function getAllUsersById($request)
{
    return User::getAllUsersById($request);
}
function getAllUsersByName($request)
{
    return User::getAllUsersByName($request);
}
function getAllUsersBySurname($request)
{
    return User::getAllUsersBySurname($request);
}
function getAllUsersByEmail($request)
{
    return User::getAllUsersByEmail($request);
}
function getAllUsersByLevel($request)
{
    return User::getAllUsersByLevel($request);
}
function getAllUsersByPokemons($request)
{
    return User::getAllUsersByPokemons($request);
}

function deleteUser($id)
{
    User::deleteUser($id);
}
