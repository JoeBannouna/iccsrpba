<?php

require 'autoload.php';
require 'core.php';

header("Content-Type: text/plain");

$logs = new Logs();

$limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;

try {
  $show = new ShowJson();
  $show->showCategories($limit);

} catch (\Throwable $th) {
  $logs->log($th, "classerrors");
}
