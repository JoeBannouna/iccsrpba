<?php

require 'autoload.php';
require 'core.php';

header("Content-Type: text/plain");

$logs = new Logs();

$limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;

try {
  
  $show = new ShowJson();
  $show->showAnnouncements($limit);

} catch (\Throwable $th) {
  $logs->log($th, "classerrors");
}

// [
//   {
//     "name": "Announcements title",
//     "description": "This is a description",
//     "date": "07-09-2020"
//   },
//   {
//     "name": "Announcements title",
//     "description": "This is a description",
//     "date": "07-09-2020"
//   }
// ]