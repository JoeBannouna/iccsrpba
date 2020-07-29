<?php

include '../php/autoload.php';
include '../php/core.php';
include '../php/mainjson.php';

$loggedin ? "" : header("Location: sign-in") && exit;

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
  <title>المركز الدولي للأستشارات والبحث العلمي والنشر وادارة الأعمال | الرئيسية</title>
  
  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="من خلال خبرتنا الممتدة سنوات في عالم الاختراعات والبحث العلمي نقدم هذا الموقع للعالم العربي بطريقة حديثة ومتطورة لكي نكون مواكبين للعالم المتقدم">
  <meta name="author" content="@DaSlackerHacker on twitter">
  <link rel="shortcut icon" href="/favicon.ico"> 
  
  <!-- FontAwesome JS-->
  <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
  
  <!-- Theme CSS -->
  <link id="theme-style" rel="stylesheet" href="/assets/css/theme-2.css">
  <link id="theme-style" rel="stylesheet" href="/assets/css/main.css?v=10">
  <link id="theme-style" rel="stylesheet" href="/assets/css/loading.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">

  <!-- Load JQuery -->
  <script src="/assets/plugins/jquery-3.3.1.min.js"></script>

  <!-- Script for the text editor -->
  <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

  <!-- Some small styles for the dashboard -->
  <style>
    * {
      text-align: right;
      direction: rtl;
    }
    
    .navbar-nav.mr-auto {
      margin-right: 0 !important;
      float: right;
    }

    .button-container {
      margin: 10% auto !important;
    }

    .btn-outline-primary:hover {
      color: white;
    }

    form {
      direction: ltr;
      text-align: left;
    }
    .custom-file-input {
      cursor: pointer;
    }
    .custom-file-label {
      cursor: pointer;
      background: rgb(47, 113, 187);
      color: white;
    }
    label.custom-file-label::after {
      display: none;
    }
    
  </style>
</head>

<body>

<?php $main = 'active'; include 'header.php'; ?>
  
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
          <spn id="create"></spn>
          <form action="../php/mainjson.php" method="POST">
          <h1>تغير عنوان الموقع</h1>
          <br><br>
            <div class="input-group mb-3">
                <input required type="text" class="form-control" name="title" value="<?php echo $json->title; ?>">
            </div>
            <input type="text" name="image" hidden required value="d">
            <div class="form-group">
              <input type="submit" class="btn btn-info w-100" value="تغير الشعار">
            </div>
          </form>
          <br><br><br><br>
          <form action="../php/mainjson.php" method="POST" enctype="multipart/form-data">
          <h1>تغير الشعار</h1>
          <img src="<?php echo $json->src; ?>" class="img-fluid w-100" alt="">
          <br><br>
          <p class="arabic"><small>يخب ان تكون زوايا الصورة 512 * 512</small></p>
            <div class="input-group mb-3">
              <div class="custom-file btn btn-info">
                <input name="file" required type="file" class="custom-file-input" id="inputGroupFile02">
                <label class="custom-file-label  btn btn-info" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">اختيار صورة</label>
              </div>
            </div>
            <input type="text" name="image" hidden required value="d">
            <div class="form-group">
              <input type="submit" class="btn btn-info w-100" value="تغير الشعار">
            </div>
          </form>
        </div>
        <div class="col-lg-4"></div>
      </div>
      <hr>
    </div> <!-- /container -->
  </main>
       
  <!-- Javascript -->
  <script src="/assets/plugins/popper.min.js"></script>
  <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
  <script src="/assets/js/main.js?v=10" activeHeaderLink="indexPage" id="main-script"></script>
  <script src="/assets/js/dashboard.js?v=10"></script>
  <script>
    if (findGetParameter("create") !== null) {
      if (findGetParameter("create") === "success") $("#create").html(`<div class="alert alert-success" role="alert">تم إنشاؤه بنجاح</div>`);
      if (findGetParameter("create") === "error") $("#create").html(`<div class="alert alert-danger" role="alert">حدث خطأ ما</div>`);
    }

    if (findGetParameter("delete") !== null) {
      if (findGetParameter("delete") === "success") $("#create").html(`<div class="alert alert-success" role="alert">تم الحذف بنجاح </div>`);
      if (findGetParameter("delete") === "error") $("#create").html(`<div class="alert alert-danger" role="alert">حدث خطأ </div>`);
      $("#inputEmail").val(findGetParameter("user"));
    }
    
    if (findGetParameter("edit") !== null) {
      if (findGetParameter("edit") === "success") $("#create").html(`<div class="alert alert-success" role="alert">تم التعديل بنجاح </div>`);
      if (findGetParameter("edit") === "error") $("#create").html(`<div class="alert alert-danger" role="alert">حدث خطأ </div>`);
    }

    if (findGetParameter("remember") !== null) {
      $("#remember").attr("checked", true);
    }

    $(function () {
      mainScript();
      const callback = function() {
        $([document.documentElement, document.body]).animate({
          scrollTop: 0
        }, 1);
      }
      pageScript(callback);
    });
  </script>
</body>
</html>