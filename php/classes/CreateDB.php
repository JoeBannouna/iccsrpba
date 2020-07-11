<?php

class CreateDB extends Model {
  
  private $databaseName;

  // Constructor for setting the database name
  function __construct() {
    
    $this->databaseName = $_ENV["DB_NAME"];

  }

  // Check if a table exists
  public function checkTable($tableName) {
    $statement = $this->connect()->prepare("DESCRIBE `$tableName`");
    if ($statement->execute()) {
      // Table exists  
      return true;
    } else {
      // Table doesn't exist
      return false;
    }
  }

  // Check the type of table to be created and execute the create statement
  private function createTable($table) {
    if ($table === "announcements") {
      $this->createAnnouncementsTable($this->databaseName);
    }
    elseif ($table === "categories") {
      $this->createCategoriesTable($this->databaseName);
    }
    elseif ($table === "services") {
      $this->createServicesTable($this->databaseName);
    }
    elseif ($table === "users") {
      $this->createUsersTable($this->databaseName);
    }
  }
  
  // Create the announcements table
  private function createAnnouncementsTable($dbName) {
    $this->executeStatement([], "CREATE TABLE `$dbName`.`announcements` ( `id` VARCHAR(31) NOT NULL , `title` VARCHAR(200) NOT NULL , `text` TEXT NOT NULL , `date` INT NOT NULL ,  PRIMARY KEY (`id`) ) ENGINE = InnoDB;");
  }
  
  // Create the categories table
  private function createCategoriesTable($dbName) {
    $this->executeStatement([], "CREATE TABLE `$dbName`.`categories` ( `id` VARCHAR(31) NOT NULL , `title` VARCHAR(200) NOT NULL , `imgurl` VARCHAR(400) NOT NULL ,  PRIMARY KEY (`id`) ) ENGINE = InnoDB;");
  }
  
  // Create the services table
  private function createServicesTable($dbName) {
    $this->executeStatement([], "CREATE TABLE `$dbName`.`services` ( `id` VARCHAR(31) NOT NULL , `cat_id` VARCHAR(300) NOT NULL , `title` VARCHAR(200) NOT NULL , `description` TEXT NOT NULL , `imgurl` VARCHAR(400) NOT NULL  , `textarea` VARCHAR(50) NOT NULL ,  PRIMARY KEY (`id`) ) ENGINE = InnoDB;");
  }
  
  // Create the users table
  private function createUsersTable($dbName) {
    $this->executeStatement([], "CREATE TABLE `$dbName`.`users` ( `id` VARCHAR(30) NOT NULL , `user` VARCHAR(50) NOT NULL , `password` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`) ) ENGINE = InnoDB;");
  }

  public function runDatabaseChecks($tables) {
    foreach ($tables as $table) {
      if ($this->checkTable($table) === false) {
        $this->createTable($table);
      }
    }
    // Check if the tables exist
    foreach ($tables as $table) if (($status = ($this->checkTable($table)) ? true : false) === false) break;
    return $status;
  }

}