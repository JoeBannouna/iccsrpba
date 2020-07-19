<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';
require 'core.php';

require_once '../vendor/autoload.php';

$functions = new Functions();

function referrer($sent) {return "Location: " . $_POST["referrer"] . "#sent" . @$sent;};

if (!isset($_SESSION['noOfSentMail'])) $_SESSION['noOfSentMail'] = 0;
if ($_SESSION['noOfSentMail'] < 30) {
    $_SESSION['noOfSentMail']++;

    $email = $_POST['email'];
    $msg = $_POST['message'];

    // print_r($_POST);die();           // For testing

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $_ENV["MAIL_SERVER"];                  // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $_ENV["MAIL_USER"];                    // SMTP username
        $mail->Password   = $_ENV["MAIL_PASSWORD"];                // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($email);
        $mail->addAddress($_ENV["RECIEVER_MAIL"], $name);     // Add a recipient
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Mail!';
        $mail->Body    = "<p>" . preg_replace("/\r|\n/", "<br>", $msg) . "</p>";
        $mail->AltBody = "$msg" . $code;
    
        $mail->send();

        $messageSent = 1;
    } catch (Exception $e) {
        $logs->log($e->getMessage());
        $messageSent = 0;
    }

    header(referrer($messageSent));         // Send the user back with a confirmation msg
} else {
    header(referrer("2"));                  // Send the user with warning msg
    $logs->log("number of sent emails over 30!", "sendmail");
}