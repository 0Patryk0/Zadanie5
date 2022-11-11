<?php

class Database
{
    private $db;
   

    public function __construct()
    {
        $this->db = new mysqli('mysql02.kirianpll.beep.pl', 'szkolna4', 'street', 'z4_');
        if(!$this->db){
            echo " MySQL Connection error." . PHP_EOL;
            echo "Errno: " . $this->db->connect_errno . PHP_EOL;
            echo "Error: " . $this->db->connect_error . PHP_EOL;
            exit();
        }
    }

    public function insertUser($user, $password): void
    {
        $this->db->query("INSERT INTO users (username, password) VALUES ('$user', '$password')");
    }

    public function close() : void
    {
        $this->db->close();
    }

    public function selectWhere($column, $table, $where, $what): array
    {
        $query = $this->db->query("SELECT $column from $table WHERE $where=$what");
        return $query->fetch_array();
    }

}

//include "Database.php";
//$db = new Database();
//$db->insertUser($user, $pass);