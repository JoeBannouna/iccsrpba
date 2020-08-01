<?php


require 'autoload.php';
require 'core.php';

$logs = new Logs();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;
  $catId = (isset($_GET["cat_id"])) ? $_GET["cat_id"] : false;

  try {
    $show = new ShowJson();
    $show->showServices($limit, $catId);
  } catch (\Throwable $th) {
    $logs->log($th);
  }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
  if ($_POST["mode"] == "DELETE") {
    if (isset($_POST["id"])) {
      if ($loggedin) {
        $model = new Model();
        if ($model->deleteService($_POST["id"])) header("Location: ../dashboard/cards?delete=success"); else header("Location: ../dashboard/cards?delete=error");
      }
    }
  }
}
