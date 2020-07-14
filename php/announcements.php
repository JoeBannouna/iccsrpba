<?php

require 'autoload.php';
require 'core.php';

$logs = new Logs();

$limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;

try {
  
  $show = new ShowJson();
  $show->showAnnouncements($limit);

} catch (\Throwable $th) {
  $logs->log($th);
}