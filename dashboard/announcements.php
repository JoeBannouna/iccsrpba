<?php

include '../php/autoload.php';
include '../php/core.php';

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
  <link id="theme-style" rel="stylesheet" href="/assets/css/main.css?v=11">
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
  </style>
</head>

<body>

<?php $announcements = 'active'; include 'header.php'; ?>
  
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
          <spn id="create"></spn>
          <h2 class="font-weight-lighter">إنشاء خبر..</h2>
          <br>
          <form action="../php/addannouncement.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <div class="form-group">
                <label for="exampleInputtext1">العنوان</label>
                <input type="text" name="title" class="form-control" id="exampleInputtext1" aria-describedby="textHelp">
              </div>
              <label for="editor1">الوصف</label>
              <textarea name="text" class="form-control" id="editor1" rows="3"></textarea>
            </div>
            <!-- <div class="form-group">
              <label for="exampleFormControlFile1">تحميل صورة</label>
              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div> -->
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="col-lg-4"></div>
      </div>
      <hr>
    </div> <!-- /container -->
  </main>

  <div class="loading-page">
      <div class="loading-icon">
        <div class="ld ld-hourglass ld-spin-fast" style="font-size:64px;color:rgb(82, 166, 218)"></div>
      </div>
      <section class="blog-list px-3 py-5 p-md-5">
        <div class="container-fluid marketing main-page-core">
          <div class="row categories-span0"></div>
          <nav aria-label="Categories pagination" class="d-flex justify-content-center width-100" id="categories-pagination">
            <ul class="pagination"></ul>
          </nav>
        </div>
      </section>
    </div>
       
  <!-- Javascript -->
  <script src="/assets/plugins/popper.min.js"></script>
  <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
  <script src="/assets/js/main.js?v=11" activeHeaderLink="indexPage" id="main-script"></script>
  <script src="/assets/js/announcements.js?v=11"></script>
  <script src="/assets/js/dashboard.js?v=11"></script>
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