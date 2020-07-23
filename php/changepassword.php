<?php

require_once 'autoload.php';
require_once 'core.php';

if ($loggedin) {
  // If values are set
  if (isset($_POST["oldpass"]) && isset($_POST["newpass"]) && isset($_POST["confirmpass"])) {
    // Check lengths
    if (
      strlen($_POST["oldpass"]) >= 8 &&
      strlen($_POST["newpass"]) >= 8
    ) {
      // Declare the post variables
      list("oldpass" => $oldPass, "newpass" => $newPass, "confirmpass" => $confirmPass) = $_POST;

      // Check if new pass and confirmed are the same
      if ($newPass === $confirmPass) {
        // Check the old pasword is correct
        $hashedPass = getUserField($functions, "password");
        $userId = getUserField($functions, "id");
        if (password_verify($oldPass, $hashedPass)) {
          // Change the password to new pass
          $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);
          $model = new Model();
          if ($model->executeStatement([$newPassHash, $userId], "UPDATE users SET password = ? WHERE id = ?")) {
            // Delete the current session
            @setcookie("user_id", $_COOKIE['user_id'], time() - 3600, "/");
            @setcookie("user_session", $_COOKIE['user_session'], time() - 3600, "/");

            // Create a new session with the new password
            setcookie("user_id", $userId, strtotime("+2 hours"), "/");
            $newPassHashSession = password_hash($userId . $newPassHash . $_ENV["SESSION_SALT"], PASSWORD_DEFAULT);
            setcookie("user_session", $newPassHashSession, strtotime("+2 hours"), "/");
            
            echo showMsg("تم تغيير كلمة السر", "success");
          } else echo showMsg("حدث خطأ", "danger");
        } else echo showMsg("كلمة مرور خاطئة", "danger");
      }
      else echo showMsg("كلمة المرور غير مطابقة", "danger");
    } 
    // Show error message for lengths
    else echo showMsg("يجب أن تتكون كلمة المرور من 8 أحرف أو أكثر", "danger");
  }
}

// Show a message to the user
function showMsg($msg, $type = "light") {
  return 
'<div class="alert alert-' . $type . '" role="alert">
  ' . $msg . '
</div>'
;

}