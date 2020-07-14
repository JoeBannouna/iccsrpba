<?php

require 'autoload.php';
require 'core.php';

$logs = new Logs();

$limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;
$catId = (isset($_GET["cat_id"])) ? $_GET["cat_id"] : false;

try {
  $show = new ShowJson();
  $show->showServices($limit, $catId);
} catch (\Throwable $th) {
  $logs->log($th);
}