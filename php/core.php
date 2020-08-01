<?php

ob_start();
@session_start();

require_once __DIR__ . '/../env.php';

$functions = new Functions();
$logs = new Logs();
$logs->log(date("m/d/Y h:i"));

$createDB = new CreateDB();
$createTables = $createDB->runDatabaseChecks(["users", "announcements", "services", "categories"]);

// Check if the user is logged in
function loggedin($object) {

    // Check if the cookies are valid
    if (isset($_COOKIE['user_id'], $_COOKIE['user_session']) && !empty($_COOKIE['user_id']) && !empty($_COOKIE['user_session'])) {

        // Get number of rows
        $idRow = $object->getRowsNo($_COOKIE['user_id'], "id", "users");

        // Check if the id exists in the database
        if ($idRow == "1") {

            // Get the password and verify it with the password in the cookie..
            $userRows = $object->getRows($_COOKIE['user_id'], "id", "users");
            $userRow = $userRows[0];
    
            $session = $userRow['id'] . $userRow['password'] . $_ENV["SESSION_SALT"];
    
            if (password_verify($session , $_COOKIE['user_session'])) {
                return true;
            } else {
                @setcookie("user_id", $_COOKIE['user_id'], time() - 3600, "/");
                @setcookie("user_session", $_COOKIE['user_session'], time() - 3600, "/");
                return false;
            }
        } else {
            @setcookie("user_id", $_COOKIE['user_id'], time() - 3600, "/");
            @setcookie("user_session", $_COOKIE['user_session'], time() - 3600, "/");
            return false;
        }
    } elseif (isset($_SESSION['user_id'], $_SESSION['user_session']) && !empty($_SESSION['user_id']) && !empty($_SESSION['user_session'])) {
        // Get number of rows
        $idRow = $object->getRowsNo($_SESSION['user_id'], "id", "users");

        // Check if the id exists in the database
        if ($idRow == "1") {

            // Get the password and verify it with the password in the cookie..
            $userRows = $object->getRows($_SESSION['user_id'], "id", "users");
            $userRow = $userRows[0];
    
            $session = $userRow['id'] . $userRow['password'] . $_ENV["SESSION_SALT"];
    
            if (password_verify($session , $_SESSION['user_session'])) {
                return true;
            } else {
                @setcookie("user_id", $_SESSION['user_id'], time() - 3600, "/");
                @setcookie("user_session", $_SESSION['user_session'], time() - 3600, "/");
                return false;
            }
        } else {
            @setcookie("user_id", $_SESSION['user_id'], time() - 3600, "/");
            @setcookie("user_session", $_SESSION['user_session'], time() - 3600, "/");
            return false;
        }
    }
    
    else {
        @session_destroy();
        @setcookie("user_id", $_COOKIE['user_id'], time() - 3600, "/");
        @setcookie("user_session", $_COOKIE['user_session'], time() - 3600, "/");
        return false;
    }
}

function getUserId($functions) {

    // Check if the cookies are valid
    if (isset($_COOKIE['user_id'], $_COOKIE['user_session']) && !empty($_COOKIE['user_id']) && !empty($_COOKIE['user_session'])) {

        // Get number of rows
        $idRow = $functions->getRowsNo($_COOKIE['user_id'], "id", "users");

        // Check if the id exists in the database
        if ($idRow == "1") {

            // Get the password and verify it with the password in the cookie..
            $userRows = $functions->getRows($_COOKIE['user_id'], "id", "users");
            $userRow = $userRows[0];

            return $userRow['id'];
        }
    }
}

// Get any field from the user
function getUserField($functions, $field) {

    // Check if the cookies are valid
    if (isset($_COOKIE['user_id'], $_COOKIE['user_session']) && !empty($_COOKIE['user_id']) && !empty($_COOKIE['user_session'])) {

        // Get number of rows
        $idRow = $functions->getRowsNo($_COOKIE['user_id'], "id", "users");

        // Check if the id exists in the database
        if ($idRow == "1") {

            // Get the password and verify it with the password in the cookie..
            $userRows = $functions->getRows($_COOKIE['user_id'], "id", "users");
            $userRow = $userRows[0];

            return $userRow[$field];
        }
    }
}

// Function for creating a secure random token
function crypto_rand_secure($min, $max) {
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

// Logging file
define("LOG_FILE", 'logs.log');
$loggedin = loggedin($functions);

?>