<?php

require_once __DIR__ . '/../../env.php';

class Dbh extends Core {
    private $host;
    private $user;
    private $pass;
    private $name;

    protected function connect() {
        
        $this->host = $_ENV["DB_HOST"];
        $this->user = $_ENV["DB_USER"];
        $this->pass = $_ENV["DB_PASS"];
        $this->name = $_ENV["DB_NAME"];

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name;
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
    
}
