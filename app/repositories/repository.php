<?php
abstract class Repository {
    protected $connection;

    function __construct() {
        require_once __DIR__ . '/../config/dbconfig.php';

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed! Please try again later...";
          }
    }       
}