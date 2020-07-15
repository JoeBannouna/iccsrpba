<?php

require 'autoload.php';
require 'core.php';

if ($loggedin) {

  $core = new Core();

  // Encode the output to be able to be put in the database
  foreach ($_POST as $key => $value) {
    $_POST[$key] = rawurlencode($value);
  }

  if ($_POST["category"] === "empty") header("Location: ../dashboard/cards?create=chooseerror") && exit;
  
  else {
    $model = new Model();
    try {
      // Upload the image..
      $model->insertPost(["id" => "", "title" => $_POST["title"], "description" => $_POST["text"], "textarea" => $_POST["textarea"], "cat_id" => $_POST["category"], "date" => time()], "services", $_FILES) 
        ? header("Location: ../dashboard/cards?create=success") && exit
        : header("Location: ../dashboard/cards?create=error") && exit;
    } catch (\PDOException $e) {
      $logs = new Logs();
      $logs->log("Err: " . $e->getMessage(), "logclasses");
      header("Location: ../dashboard/cards?create=imageerror");
      exit;
    }
  }
}