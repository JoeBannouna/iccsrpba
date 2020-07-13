<?php

class Model extends Dbh {
    // THE MODEL (The only class which interacts with the database)

    // Select a user from the database based on a certain field
    public function getRows($value, $field, $table) {
        $sql = "SELECT * FROM `$table` WHERE `$field` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$value]);

        $results = $stmt->fetchAll();
        return $results;
    }

    public function getAllRows($table, $limit = false) {
        $limit = ($limit !== false && is_numeric($limit)) ? "LIMIT $limit" : "";
        $sql = "SELECT * FROM `$table` WHERE 1 ORDER BY `date` DESC $limit;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll();
        return $results;
    }

    public function getUser($valueArr, $fieldArr, $table) {
        $sql = "SELECT * FROM `$table` WHERE `$fieldArr[0]` = ? AND `$fieldArr[1]` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$valueArr[0], $valueArr[1]]);

        $results = $stmt->fetchAll();
        return $results;
    }
    
    public function searchRows($valueArr, $fieldArr, $table) {
        (count($valueArr) == count($fieldArr)) or die("search function requires two arrays with the same size!");
        $numberOfFields = count($valueArr) - 1;
        $i = 0;
        $query = "";
        while ($i <= $numberOfFields) {
            $query .= "`$fieldArr[$i]` LIKE CONCAT('%', ?, '%')";
            if ($i != $numberOfFields) $query .= " OR ";
            $i++;
        }
        $sql = "SELECT * FROM `$table` WHERE " . $query;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($valueArr);

        $results = $stmt->fetchAll();
        return $results;
    }

    // Get the number of rows based on a certain field
    public function getRowsNo($value, $field, $table) {
        $sql = "SELECT count(*) FROM `$table` WHERE `$field` = ?";
        
        // Perform the query
        $stmtNoOfRows = $this->connect()->prepare($sql);
        $stmtNoOfRows->execute([$value]);
        $noOfRows = $stmtNoOfRows->fetch();

        // Return the number of rows registered with the ip or the user id
        return $noOfRows['count(*)'];
    }

    // Execute a certain sql statement
    public function executeStatement($array, $sql) {
        $stmt = $this->connect()->prepare($sql);
        if ($stmt->execute($array)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertPost($array, $table, $img = null) {
        // Check the ID is unique
        do $array["id"] = $this->getToken(30); while ($this->getRowsNo($array["id"], "id", $table) > 0);

        // Upload the image and put its URL in the database
        if ($img !== null) {
            $upload = $this->uploadImage($img, $table, $array["id"]);
            if ($upload === false) throw new Exception("Image could not be uploaded!");
        }
        
        // Create the arrays for the sql statement
        $values = $fields = $valuesReplacements = [];
        foreach ($array as $key => $value) array_push($fields, $key) && array_push($values, $value) && array_push($valuesReplacements, "?");
        $valuesReplacements = implode(", ", $valuesReplacements);
        $fields = implode(", ", $fields);
        $sql = "INSERT INTO $table($fields) VALUES ($valuesReplacements)";

        // Execute..
        return $this->executeStatement($values, $sql) ? true : false;
    }
}