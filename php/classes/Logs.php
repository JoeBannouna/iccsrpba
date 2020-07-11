<?php

require_once __DIR__ . '/../../env.php';

class Logs {

    function __construct() {
        if (DEV_MODE) {
            if (!file_exists(LOG_PATH . "/logclass.log")) {
                mkdir(ROOT_DIR . "/logs", 0755);
                error_log("Logging initiated..\n", 3, LOG_PATH . "/logclass.log");
            }
        }
    }
    
    public function log($msg, $file = "main") {
        if (DEV_MODE) {
            error_log("\n" . print_r($msg, true), 3, LOG_PATH . "/$file.log");
        }
    }

}