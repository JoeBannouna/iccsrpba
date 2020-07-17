<?php

require 'autoload.php';
require 'core.php';

$logs = new Logs();

$limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;
$cardId = (isset($_GET["id"])) ? $_GET["id"] : false;

try {
  $show = new ShowJson();
  $show->showCardPage($cardId);
} catch (\Throwable $th) {
  $logs->log($th);
}

// {
//   "id": "foubekjfs",
//   "name": "doing and doing other stuff",
//   "description": "this is the description for the stuff that should be descripted lmao",
//   "imgurl": "images/cards/test.png",
//   "textarea": "شرح الرسومات"
// }