<?php


require 'autoload.php';
require 'core.php';

$logs = new Logs();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;
  
  $catId = $_GET["id"];
  
  try {
    $show = new ShowJson();
    $show->showCategory($catId, $limit);
  
  } catch (\Throwable $th) {
    $logs->log($th);
  }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
  if ($_POST["mode"] == "DELETE") {
    if (isset($_POST["id"])) {
      if ($loggedin) {
        $model = new Model();
        if ($model->deleteCategory($_POST["id"])) header("Location: ../dashboard/categories?delete=success"); else header("Location: ../dashboard/categories?delete=error");
      }
    }
  }
}
