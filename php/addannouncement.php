<?php

require 'autoload.php';
require 'core.php';

if ($loggedin) {

  $model = new Model();
  $model->insertPost(["id" => "", "title" => $_POST["title"], "text" => $_POST["text"], "date" => time()], "announcements") 
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
