<?php

require_once 'autoload.php';
require_once 'core.php';

// print_r($_POST) && die();

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $model = new Model();
  
  if (isset($_POST["title"])) {
    if ($_FILES["file"]["name"] !== "") $img = $_FILES; else $img = null;
    if ($loggedin) {
      $model->updatePost($id, ["title" => $_POST["title"], "cat_id" => $_POST["category"], "description" => $_POST["text"], "textarea" => $_POST["textarea"]], "services", $img) 
      ? header("Location: cards?edit=success") 
      : header("Location: cards?edit=error");
    }
  }
  
  function getService() {
    global $model;
    global $id;
    if (isset($id)) {
      @$service = $model->getRows($id, "id", "services")[0];
      if (isset($service)) {
        return $service;
      } else {
        die("This service not exist.");
      }
    } else {
      die("This service not exist");
    }
  }

  $service = getService();
  list("title" => $name, "id" => $serviceId, "textarea" => $textarea, "description" => $description, "cat_id" => $catId, ) = $service;
  $imgSrc = $serviceId . ".png?v=" . rand(0, 100000);
}