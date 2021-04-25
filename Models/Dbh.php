<?php

class Dbh
{
    function connect()
    {

        $servername = "localhost";
        $username = "admin";
        $password = "test1234";
        $dbname = "pokemon_go";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            echo "Connection error: " . mysqli_connect_error();
        }
        return $conn;
    }
}
