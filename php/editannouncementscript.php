<?php


require_once 'autoload.php';
require_once 'core.php';

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $model = new Model();
  
  $pageUrl = $_SERVER["REDIRECT_URL"] . "?" . $_SERVER["REDIRECT_QUERY_STRING"];
  if (isset($_POST["title"])) {
    if ($loggedin) {
      $model->updatePost($id, ["name" => $_POST["title"], "description" => $_POST["text"]], "announcements") 
      ? header("Location: announcements?edit=success") 
      : header("Location: announcements?edit=error");
    }
  }
  
  function getAnnouncement() {
    global $model;
    global $id;
    if (isset($id)) {
      @$announcement = $model->getRows($id, "id", "announcements")[0];
      if (isset($announcement)) {
        return $announcement;
      } else {
        die("This announcement not exist.");
      }
    } else {
      die("This announcement not exist");
    }
  }

  $announcement = getAnnouncement();
  list("name" => $name, "description" => $description) = $announcement;
}