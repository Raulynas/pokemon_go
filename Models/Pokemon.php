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
        echo $sql;
        $dbh->connect()->query($sql);
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
        $this->max_attack = $maxAttack;
    }
    public function getMaxAttack()
    {
        return $this->maxAttack;
    }

    public function setMaxDefence($maxDefence)
    {
        $this->max_defence = $maxDefence;
    }
    public function getMaxDefence()
    {
        return $this->maxDefence;
    }

    public function setMaxStamina($maxStamina)
    {
        $this->max_stamina = $maxStamina;
    }
    public function getMaxStamina()
    {
        return $this->maxStamina;
    }




    static function getAllPokemonsByName()
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
    static function getAllPokemonsById()
    {
        $dbh = new Dbh();
        $sql = "SELECT * from `pokemons` ORDER BY `id`";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsByAttack()
    {
        $dbh = new Dbh();
        $sql = "SELECT * from `pokemons` ORDER BY `max_attack` DESC";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsByDefence()
    {
        $dbh = new Dbh();
        $sql = "SELECT * from `pokemons` ORDER BY `max_defence` DESC";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
    static function getAllPokemonsByStamina()
    {
        $dbh = new Dbh();
        $sql = "SELECT * from `pokemons` ORDER BY `max_stamina` DESC";
        $result = $dbh->connect()->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pokemon = new Pokemon($row['id'], $row['name'], $row['max_attack'], $row['max_defence'], $row['max_stamina'], $row['photo']);
            $pokemons[] = $pokemon;
        }
        return $pokemons;
    }
}

