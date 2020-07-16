<?php

require 'autoload.php';
require 'core.php';

if ($loggedin) {

  $core = new Core();

  // // Encode the output to be able to be put in the database
  // foreach ($_POST as $key => $value) {
  //   $_POST[$key] = rawurlencode($value);
  // }

  $model = new Model();

  try {
    // Upload the image..
    $model->insertPost(["id" => "", "name" => $_POST["title"], "date" => time()], "categories", $_FILES) 
      ? header("Location: ../dashboard/categories?create=success") && exit
      : header("Location: ../dashboard/categories?create=error") && exit;
  } catch (\Exception $e) {
    $logs = new Logs();
    $logs->log("Err: " . $e->getMessage(), "logclasses");
    header("Location: ../dashboard/categories?create=imageerror");
    exit;
  }
}