<?php

class Core extends Logs {
  // Function for generating a token
  protected function getToken($length) {
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
    }

    return $token;
  }

  // Uplaoding images
  protected function uploadImage($files, $directory, $filename) {
    // Some data about the file
    $name = $files['file']['name'];
    $tmp_name = $files['file']['tmp_name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $extentions = ["jpg", "jpeg", "png", "gif", "raw", "JPG", "JPEG", "PNG", "GIF", "RAW"];

    if (in_array($ext, $extentions)) {      // Verify extenstions
      if (isset($name)) {
        if (!empty($name)) {
          $location = ROOT_DIR . "/images/$directory/";
          
          // Check if directory exists and created
          if (!file_exists($location."test.log")) {
            mkdir(ROOT_DIR . "/images/$directory", 0755);
            file_put_contents($location."test.log", "File and Directory has been created");
          }

          // Save the file and return the extention
          if (move_uploaded_file($tmp_name, $location.$filename.".png")) {
              return $location.$filename.".png";
          }
        }
      }
    }
    return false;
  }
  
  public function sendFile($files, $i) {
    $name = $files['file']['name'][$i];
    $tmp_name = $files['file']['tmp_name'][$i];

    if (isset($name)) {
      if (!empty($name)) {
        $location = ROOT_DIR . "/images/mail/";
        
        // Check if directory exists and created
        if (!file_exists($location."test.log")) {
          mkdir(ROOT_DIR . "/images/mail", 0755);
          file_put_contents($location."test.log", "File and Directory has been created");
        }

        // Save the file and return the extention
        if (move_uploaded_file($tmp_name, $location.$name)) {
            return $location.$name;
        }
      }
    }
    return false;
  }
}