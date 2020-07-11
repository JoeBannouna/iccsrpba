<?php

require '../env.php';

spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $path = "/php/classes/";
    $extention = ".php";
    $fullPath = ROOT_DIR . $path . $className . $extention;

    if (!file_exists($fullPath)) {
        return false;
    }

    include $fullPath;
}