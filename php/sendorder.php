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
$core = new Core();

function referrer($sent) {return "Location: " . $_POST["referrer"] . "#sent" . @$sent;};

if (!isset($_SESSION['noOfSentMail'])) $_SESSION['noOfSentMail'] = 0;
if ($_SESSION['noOfSentMail'] < 30) {
  $_SESSION['noOfSentMail']++;

  list(
    "subject"   =>  $subject, 
    "order-url" =>  $orderUrl,
    "name"      =>  $name, 
    "email"     =>  $email, 
    "order"     =>  $order, 
    "text"      =>  $msg
  ) = $_POST;

  // Add extra details to the body
  $msg = " Order: $order\n\n" . $msg;

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
    $mail->CharSet = 'UTF-8';                                   // Set the charset

    //Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress($_ENV["RECIEVER_MAIL"]);     // Add a recipient

    // Attaching files
    if ($_FILES['file']['name'][0] !== "") {              // If any files exists
      $myFile = $_FILES['file'];
      if (count($myFile['name']) > 10) throw new Exception("Too much images!");
      else {
        for ($i=0; $i < count($myFile['name']); $i++) {
          $sentFile = $core->sendFile($_FILES, $i);
          $logs->log($sentFile, "sendmail");
          if (($mail->addAttachment($sentFile)) === false) $logs->log("THE FILE COULD NOT BE SENT", "sendmail");
          $logs->log($sentFile, "sendmail");
        }
      }
    }

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "New Order: $subject";
    $mail->Body    = "The order: <a href=\"$orderUrl\">$orderUrl</a><br><br><p>" . preg_replace("/\r|\n/", "<br>", $msg) . "</p>";
    $mail->AltBody = $msg;

    $mail->send();

    $messageSent = 1;
  } catch (Exception $e) {
    $logs->log($e->getMessage(), "sendmail");
    $messageSent = 0;
  }

  header(referrer($messageSent));         // Send the user back with a confirmation msg
} else {
  header(referrer("2"));                  // Send the user with warning msg
  $logs->log("number of sent emails over 30!", "sendmail");
}