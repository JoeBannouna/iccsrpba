<?php

require_once 'autoload.php';
require_once 'core.php';

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $model = new Model();
  
  if (isset($_POST["title"])) {
    if ($_FILES["file"]["name"] !== "") $img = $_FILES; else $img = null;
    if ($loggedin) {
      $model->updatePost($id, ["name" => $_POST["title"]], "categories", $img) 
      ? header("Location: categories?edit=success") 
      : header("Location: categories?edit=error");
    }
  }
  
  function getCategory() {
    global $model;
    global $id;
    if (isset($id)) {
      @$category = $model->getRows($id, "id", "categories")[0];
      if (isset($category)) {
        return $category;
      } else {
        die("This category not exist.");
      }
    } else {
      die("This category not exist");
    }
  }

  $category = getCategory();
  list("name" => $name, "id" => $catId) = $category;
  $imgSrc = $catId . ".png";
}