<?php


require 'autoload.php';
require 'core.php';

$logs->log("login script initiated", "login");

// Set some variables
$ip = $_SERVER['REMOTE_ADDR'];
$date = time();
$functions = new Functions();

// Check if the user is logged in
if (!$loggedin) {

  $user = $_POST;

  // Check if the values exist
  if (isset($user["user"], $user["password"])) {
    $remember = (isset($user["remember"])) ? true : true;
    $rememberString = ($remember) ? "&remember=1" : "";

    // Check if the values are empty
    if (!empty($user)) {

      // Check if the values are just spaces
      if ($functions->emptyVal($user["user"])) {

        // Get the users credentials from the database
        $userRows = $functions->getRows($user["user"], "user", "users");
        @$userRow = $userRows[0];

        if (is_array($userRow) && count($userRow) > 1) {

          // Check if password is correct
          if (password_verify($user["password"], $userRow['password'])) {

            $hashedSession = password_hash($userRow['id'] . $userRow['password'] . $_ENV["SESSION_SALT"], PASSWORD_DEFAULT);
            
            if ($remember) {
              // Start a cookie session
              setcookie("user_id", $userRow['id'], strtotime("+2 hours"), "/");
              setcookie("user_session", $hashedSession, strtotime("+2 hours"), "/");
            } else {
              // Start a session
              @session_start();
              $_SESSION["user_id"] = $userRow['id'];
              $_SESSION["user_session"] = $hashedSession;
            }
            
            echo '<meta http-equiv="refresh" content="0;URL=\'../dashboard\'" />';

          } else {
            $meta = '<meta http-equiv="refresh" content="0;URL=\'../dashboard/sign-in?e=invalid&user=' . $user["user"] . $rememberString . '\'" />';
            $logs->log($meta, "login");
            echo $meta;
          }
        } else {
          $meta = '<meta http-equiv="refresh" content="0;URL=\'../dashboard/sign-in?e=invalid&user=' . $user["user"] . $rememberString . '\'" />';
          $logs->log($meta, "login");
          echo $meta;
        }
      }
    }
  }
} else {
  $meta = '<meta http-equiv="refresh" content="0;URL=\'../dashboard/\'" />';
  $logs->log($meta, "login");
  echo $meta;
}

$logs->log("login script ended", "login");