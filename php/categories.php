<?php

require_once 'autoload.php';
require_once 'core.php';

$logs = new Logs();

$limit = (isset($_GET["limit"])) ? $_GET["limit"] : false;

try {
  $show = new ShowJson();
  $show->showCategories($limit);

} catch (\Throwable $th) {
  $logs->log($th, "classerrors");
}
