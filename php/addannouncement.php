<?php

require 'autoload.php';
require 'core.php';

if ($loggedin) {

  // foreach ($_POST as $key => $value) {
  //   $_POST[$key] = rawurlencode($value);
  // }

  $model = new Model();
  $model->insertPost(["id" => "", "name" => $_POST["title"], "description" => $_POST["text"], "date" => time()], "announcements") 
  ? header("Location: ../dashboard/announcements?create=success") 
  : header("Location: ../dashboard/announcements?create=error");
}