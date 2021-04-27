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

function getUserId($request)
{
    $dbh = new Dbh();
    $sql = "SELECT * from `users` where email ='" . $request['email'] . "'";
    $result =  $dbh->connect()->query($sql);
    while ($row = $result->fetch_assoc()) {
        return $row["id"];
    }
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
function getAllUsersSorted($arg, $order)
{
    return User::getAllUsersSorted($arg, $order);
}


function getUserPokemons($user_id)
{
    return User::getUserPokemons($user_id);
}


function deleteUser($id)
{
    User::deleteUser($id);
}
