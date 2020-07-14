<?php

require 'autoload.php';
require 'core.php';

if ($loggedin) {

  foreach ($_POST as $key => $value) {
    $_POST[$key] = rawurlencode($value);
  }

  $model = new Model();
  $model->insertPost(["id" => "", "name" => $_POST["title"], "description" => $_POST["text"], "date" => time()], "announcements") 
  ? header("Location: ../dashboard/announcements?create=success") 
  : header("Location: ../dashboard/announcements?create=error");

  // echo @$name = $_FILES['file']['name'];
  // echo @$tmp_name = $_FILES['file']['tmp_name'];
  
  // if (isset($name)) {
  //   if (!empty($name)) {
  //     $location = ROOT_DIR . '/images/announcements/';
  
  //     if (move_uploaded_file($tmp_name, $location.$name)) {
  //         echo "UPLOADED!";
  //     }
  //   }
  // }
}