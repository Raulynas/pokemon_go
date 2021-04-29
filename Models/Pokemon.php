<?php
include("Dbh.php");


class Pokemon
{

    private $id;
    private $name;
    private $maxAttack;
    private $maxDefence;
    private $maxStamina;

    function __construct($id, $name, $maxAttack, $maxDefence, $maxStamina)
    {
        $this->id = $id;
        $this->name = $name;
        $this->maxAttack = $maxAttack;
        $this->maxDefence = $maxDefence;
        $this->maxStamina = $maxStamina;
    }

    public function save()
    {
        $dbh = new Dbh();
        $sql = "INSERT INTO `pokemons` (`id`, `name`, `max_attack`, `max_defence`, `max_stamina`)
        VALUES (NULL, '" . $this->getName() . "', '" . $this->getMaxAttack() . "', '" . $this->getMaxDefence() . "', '" . $this->getMaxStamina() . "')";
        if ($dbh->connect()->query($sql)) {
            //success
            header("Location:../views/addPokemon.php");
        } else {
            echo "ERROR: Pokemon has not been saved to database";
        };
    }

    //GETTERS & SETTERS//

    public function setId($id)
    {
        $this->name = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setName($name)
    {
        $this->name = ucfirst($name);
    }
    public function getName()
    {
        return $this->name;
    }
    public function setMaxAttack($maxAttack)
    {
        $this->maxAttack = $maxAttack;
    }
    public function getMaxAttack()
    {
        return $this->maxAttack;
    }

    public function setMaxDefence($maxDefence)
    {
        $this->maxDefence = $maxDefence;
    }
    public function getMaxDefence()
    {
        return $this->maxDefence;
    }

    public function setMaxStamina($maxStamina)
    {
        $this->maxStamina = $maxStamina;
    }
    public function getMaxStamina()
    {
        return $this->maxStamina;
    }

    static function getPokemonOwningUsers($pokemon_id)
    {

        $users = [];
        $user = [];
        $dbh = new Dbh();
        $sql = "SELECT
        u.id,
        u.email
        FROM
        users AS u
        INNER JOIN user_pokemons AS up
        ON
        up.user_id = u.id
        INNER JOIN pokemons AS p
        ON 
        up.pokemon_id = p.id  
        WHERE
        p.id = $pokemon_id
        GROUP BY u.id";
        $result = $dbh->connect()->query($sql);
        while ($row = $result->fetch_assoc()) {

            $user["id"] = $row["id"];
            $user["email"] = $row["email"];
            $users[] = $user;
        };
        return $users;
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
    static function getAllPokemons()
    {
        $dbh = new Dbh();
        $sql = "SELECT * from `pokemons` ORDER BY `name`";
        $result = $dbh->connect()->query($sql);
        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsByName($order)
    {
        $dbh = new Dbh();
        $sort = $order ? "ASC" : "DESC";

        $sql = "SELECT * from `pokemons` ORDER BY `name` $sort";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsById($order)
    {
        $dbh = new Dbh();
        $sort = $order ? "ASC" : "DESC";
        $sql = "SELECT * from `pokemons` ORDER BY `id` $sort";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsByAttack($order)
    {
        $dbh = new Dbh();
        $sort = $order ? "ASC" : "DESC";
        $sql = "SELECT * from `pokemons` ORDER BY `max_attack` $sort";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsByDefence($order)
    {
        $dbh = new Dbh();
        $sort = $order ? "ASC" : "DESC";

        $sql = "SELECT * from `pokemons` ORDER BY `max_defence` $sort";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsByStamina($order)
    {
        $dbh = new Dbh();
        $sort = $order ? "ASC" : "DESC";

        $sql = "SELECT * from `pokemons` ORDER BY `max_stamina` $sort";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }

    static function addPokemonToUser($user_id, $pokemon_id, $attack, $defence, $stamina)
    {
        $dbh = new Dbh();
        $sql = "INSERT INTO `user_pokemons` (`id`, `pokemon_id`, `user_id`, `attack`, `defence`, `stamina`) VALUES (NULL, $pokemon_id, $user_id, $attack, $defence, $stamina)";
        $dbh->connect()->query($sql);
    }


    static function deletePokemon($id_to_delete)
    {
        $dbh = new Dbh();
        $sql = "DELETE from `pokemons` WHERE id = $id_to_delete";
        $dbh->connect()->query($sql);
    }
}
