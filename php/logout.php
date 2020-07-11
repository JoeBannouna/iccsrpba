<?php

require 'autoload.php';
require 'core.php';

@session_destroy();
@setcookie("user_id", $_COOKIE['user_id'], time() - 3600, "/");
@setcookie("user_session", $_COOKIE['user_session'], time() - 3600, "/");

header('Location: ../dashboard/');
