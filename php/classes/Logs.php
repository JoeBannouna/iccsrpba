<?php

require_once __DIR__ . '/../../env.php';
class Logs {

    private $colorFormats = array(
        // styles
        // italic and blink may not work depending of your terminal
        'bold' => "\033[1m%s\033[0m",
        'dark' => "\033[2m%s\033[0m",
        'italic' => "\033[3m%s\033[0m",
        'underline' => "\033[4m%s\033[0m",
        'blink' => "\033[5m%s\033[0m",
        'reverse' => "\033[7m%s\033[0m",
        'concealed' => "\033[8m%s\033[0m",
        // foreground colors
        'black' => "\033[30m%s\033[0m",
        'red' => "\033[31m%s\033[0m",
        'green' => "\033[32m%s\033[0m",
        'yellow' => "\033[33m%s\033[0m",
        'blue' => "\033[34m%s\033[0m",
        'magenta' => "\033[35m%s\033[0m",
        'cyan' => "\033[36m%s\033[0m",
        'white' => "\033[37m%s\033[0m",
        // background colors
        'bg_black' => "\033[40m%s\033[0m",
        'bg_red' => "\033[41m%s\033[0m",
        'bg_green' => "\033[42m%s\033[0m",
        'bg_yellow' => "\033[43m%s\033[0m",
        'bg_blue' => "\033[44m%s\033[0m",
        'bg_magenta' => "\033[45m%s\033[0m",
        'bg_cyan' => "\033[46m%s\033[0m",
        'bg_white' => "\033[47m%s\033[0m",
    );

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