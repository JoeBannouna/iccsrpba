<?php

require_once __DIR__ . '/../../env.php';

class Functions extends Model {

    // A fucntion to check if values are just spaces
    public function emptyVal($value) {
        if (!empty(str_replace(" ", "", $value))) {
            return true;
        } else {
            return false;
        }
    }

    // Captcha verification
    public function captchaIsValid($secretKey, $response) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'secret'   => $secretKey,
            'response' => $response,
        ]));
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $data = curl_exec($ch);
        curl_close($ch);
        
        $response = @json_decode($data);
        
        if ($response && $response->success) {
            return true;
        } else {
            return false;
        }
    }

    // Email validation
    public function emailIsValid($email) {
        if (isset($email) && !empty($email)) {

            // Get number of rows with email
            $noOfRows = $this->getRowsNo($email, "email", "users");
            
            // If 0 and valid email return true
            if ($noOfRows == 0) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
            
        }
    }

    // Register a new user
    public function registerUser($valuesArray) {

        // Enter the user into the database
        $sql = "INSERT INTO users(`name`, email, `password`, validated, ip, weborapp, `date`, renew, country) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $hashed_password = password_hash($valuesArray[2], PASSWORD_DEFAULT);
        $rc = array(str_replace("%20", " ", $valuesArray[0]), $valuesArray[1], $hashed_password, "1", $valuesArray[4], "1", time(), date('d'), $valuesArray[5]);

        if ($this->executeStatement($rc, $sql)) {
            return true; 
        } else {
            return true;
        }
    }

    public function sendlog($msg, $logType) {
        
        // Set log color
        if ($logType == "log") {
            $logColor = "#222";
        } else if ($logType == "errorlog") {
            $logColor = "red";
        } else if ($logType == "successlog") {
            $logColor = "green";
        }

        $file = __DIR__ . "/../../logs";

        $log = '<div style="font-family: Arial;color: #333;"><hr><strong style="color: ' . $logColor . '">' . $msg . '</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $_SERVER['PHP_SELF'] . ' <span style="float: right;"><strong>' . date("h:i") . "</strong> - " . date("d/M/Y") . "</span><br><br></div>\n\n\n";

        if (file_exists($file)) {

            // If file exists append to it
            $handle = fopen($file, "a");
            fwrite($handle, $log);
            fclose($handle);

            return true;
        } else {

            // If file does not exist create and put data to it
            file_put_contents($file, $log);
            return true;
        }
    }

    public function works() {
        return true;
    }
}