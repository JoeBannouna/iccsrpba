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
// $model = new Model;
// print_r($model->getAllRows("categories", $limit));

// [
//   {
//     "id": "ofebfeo",
//     "name": "testcat1",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "uoeffbf",
//     "name": "science",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "lorkonfie",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "eiorflore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "wfniofrlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "frrflore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "oorfmolore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "okdekolore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "jnedjlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "ofmrfklore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "mkwskmlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "hfrufrhlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "jncdjndclore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "ifrnrfjnlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "kmsxkmsxlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "frmifmrlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "ikmekdmdlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "dekmdekmdlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "ofionff",
//     "name": "dmekdmdlore",
//     "imgurl": "images/categories/image.png"
//   },
//   {
//     "id": "feklsnfef",
//     "name": "eftestcat4",
//     "imgurl": "images/categories/image.png"
//   }
// ]