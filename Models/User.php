<?php
include("Pokemon.php");

class User
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $permission_lvl;

    function __construct($id, $name, $surname, $email, $password, $permission_lvl)
    {
        $this->id = $id;
        $this->name = ucfirst(strtolower($name));
        $this->surname = ucfirst(strtolower($surname));
        $this->email = $email;
        $this->password = $password;
        $this->permission_lvl = $permission_lvl;
    }


    public function save()
    {
        $dbh = new Dbh();
        $sql = "INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `permission_lvl`) 
        VALUES (NULL, '" . $this->getName() . "', '" . $this->getSurname() . "',  '" . $this->getEmail() . "', '" . $this->getPassword() . "', '$this->getPermission_lvl()')";
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
        return strtolower($this->email);
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


    public function setPermission_lvl($value)
    {
        $this->permission_lvl = $value;
    }
    public function getPermission_lvl()
    {
        return $this->permission_lvl;
    }
    //GETTERS & SETTERS//



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
    static function getUserById($request)
    {
        $dbh = new Dbh();
        $sql = "SELECT * from `users` WHERE id = $request";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['surname'], $row['email'], NULL, $row['permission_lvl']);
            return $user;
        }
    }
    static function getAllUsers()
    {
        $users = [];
        $dbh = new Dbh();

        $sql = "SELECT u.id AS user_id,
        u.name AS user_name,
        u.surname,
        u.email,
        u.permission_lvl,
        COUNT(up.user_id) AS number_of_pokemons
        FROM users AS u
        LEFT JOIN user_pokemons AS up
        ON u.id = up.user_id
        GROUP BY u.id";
        $result = $dbh->connect()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $user = new User($row['user_id'], $row['user_name'], $row['surname'], $row['email'], NULL, $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }
    static function getAllUsersSorted($arg, $order)
    {
        $users = [];
        $dbh = new Dbh();
        $sort = $order ? "DESC" : "ASC";
        $sql = "SELECT u.id AS user_id,
        u.name AS user_name,
        u.surname,
        u.email,
        u.permission_lvl,
        COUNT(up.user_id) AS number_of_pokemons
        FROM users AS u
        LEFT JOIN user_pokemons AS up
        ON u.id = up.user_id
        GROUP BY u.id
        ORDER BY $arg $sort";

        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $user = new User($row['user_id'], $row['user_name'], $row['surname'], $row['email'], NULL, $row['permission_lvl']);
            $users[] = $user;
        }
        return $users;
    }



    static function getUserPokemons($user_id) :array
    {
        $pokemons = [];
        $dbh = new Dbh();
        $sql = "SELECT p.id AS pokemon_id
        FROM pokemons AS p
        INNER JOIN user_pokemons AS up
        ON
            p.id = up.pokemon_id
        INNER JOIN users AS u
        ON
            up.user_id = u.id
        WHERE
            u.id = $user_id";
        $result = $dbh->connect()->query($sql);
        while($row = $result->fetch_assoc()){

            $pokemons[]= $row["pokemon_id"];
        };
        return $pokemons;
    }
















    static function deleteUser($id)
    {
        $dbh = new Dbh();
        $sql = "DELETE from `users` WHERE id = $id";
        $dbh->connect()->query($sql);
    }
}
