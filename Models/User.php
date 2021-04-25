<?php
include("Pokemon.php");

class User
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $ownedPokemons;
    private $permission_lvl;

    public function toJson($var)
    {
        return json_encode($var);
    }
    public function fromJson($var)
    {
        return json_decode($var);
    }

    function __construct($id, $name, $surname, $email, $password, $ownedPokemons, $permission_lvl)
    {
        $this->id = $id;
        $this->name = ucfirst(strtolower($name));
        $this->surname = ucfirst(strtolower($surname));
        $this->email = $email;
        $this->password = $password;
        $this->ownedPokemons = $ownedPokemons;
        $this->permission_lvl = $permission_lvl;
    }


    public function save()
    {
        $dbh = new Dbh();
        $sql = "INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `ownedPokemons`, `permission_lvl`) 
        VALUES (NULL, '" . $this->getName() . "', '" . $this->getSurname() . "',  '" . $this->getEmail() . "',  '" . $this->getPassword() . "', '" . $this->toJson($this->getOwnedPokemons) . "', '$this->getPermission_lvl()')";
        $dbh->connect()->query($sql);
    }

    //GETTERS & SETTERS//

    public function getId()
    {
        return $this->id;
    }
    //-----------//
    public function setName($value)
    {
        $this->name = ucfirst($value);
    }
    public function getName()
    {
        return $this->name;
    }
    //-----------//
    public function setSurname($value)
    {
        $this->Surname = ucfirst($value);
    }
    public function getSurname()
    {
        return $this->surname;
    }
    //-----------//

    public function setEmail($value)
    {
        $this->email = $value;
    }
    public function getEmail()
    {
        return $this->email;
    }
    //-----------//

    public function setPassword($value)
    {
        $this->password = $value;
    }
    public function getPassword()
    {
        return $this->password;
    }
    //-----------//

    public function setOwnedPokemons($value)
    {
        $this->ownedPokemons = $value;
    }
    public function getOwnedPokemons()
    {
        return $this->fromJson($this->ownedPokemons);
    }
    //-----------//

    public function setPermission_lvl($value)
    {
        $this->permission_lvl = $value;
    }
    public function getPermission_lvl()
    {
        return $this->permission_lvl;
    }
    //GETTERS & SETTERS//


    static function getAllUserPokemons($request) // returns list of pokemon ID's
    {
        $dbh = new Dbh();
        $sql = "SELECT `ownedPokemons` FROM `users` WHERE `email` = '$request'";
        $result = $dbh->connect()->query($sql);
        $row = $result->fetch_assoc();
        return (json_decode($row['ownedPokemons']));
    }



    static function getPokemonById($request)
    {
        $dbh = new Dbh();
        $sql = "SELECT * from `pokemons` WHERE  `id` = '$request'";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);

            return $pokemon;
        }
    }
    static function getAllUsersById()
    {
        $users = [];
        $dbh = new Dbh();
        $sql = "SELECT * from `users` ORDER BY `id`";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['ownedPokemons'], $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }

    static function getAllUsersByName() {
        $users = [];
        $dbh = new Dbh();
        $sql = "SELECT * from `users` ORDER BY `name`";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['ownedPokemons'], $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }
    static function getAllUsersBySurname() {
        $users = [];
        $dbh = new Dbh();
        $sql = "SELECT * from `users` ORDER BY `surname`";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['ownedPokemons'], $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }
    static function getAllUsersByEmail() {
        $users = [];
        $dbh = new Dbh();
        $sql = "SELECT * from `users` ORDER BY `email`";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['ownedPokemons'], $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }
    static function getAllUsersByLevel() {
        $users = [];
        $dbh = new Dbh();
        $sql = "SELECT * from `users` ORDER BY `permission_lvl` DESC";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['ownedPokemons'], $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }
    static function getAllUsersByPokemons() {
        $users = [];
        $dbh = new Dbh();
        $sql = "SELECT * from `users` ORDER BY `ownedPokemons`";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], $row['password'], $row['ownedPokemons'], $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }

    
}
