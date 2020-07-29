<?php

require_once 'autoload.php';
require_once 'core.php';

switch ($_SERVER["REQUEST_METHOD"]) {
  case 'GET':
    echo file_get_contents(ROOT_DIR . "/json/main.json");
    $json = file_get_contents(ROOT_DIR . "/json/main.json");
    $json = json_decode($json, false);  
    break;
  
  case 'POST':
    $json = file_get_contents(ROOT_DIR . "/json/main.json");
    $json = json_decode($json, false);
    if (isset($_POST["title"])) {
      $json->title = $_POST["title"];         // Change title
    } else if (isset($_POST["image"])) {
      // Uplaod new image
      $core = new Core();
      unlink($json->src);         // Delete old file
      $time = time();
      $core->uploadImage($_FILES, "main", "main" . $time);    // Uplaod and set new one
      $json->src = "/images/main/main" . $time.".png";
    }
    $json = json_encode($json);
    file_put_contents(ROOT_DIR . "/json/main.json", $json);
    header("Location: ../dashboard/main?create=success");
    break;
  
  default:
    echo file_get_contents(ROOT_DIR . "/json/main.json");
    break;
}