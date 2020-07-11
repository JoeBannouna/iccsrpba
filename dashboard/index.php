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
  <meta name="description" content="من خلال خبرتنا الممتدة أكثر من 20 سنة في عالم الاختراعات والبحث العلمي نقدم هذا الموقع للعالم العربي بطريقة حديثة ومتطورة لكي نكون مواكبين للعالم المتقدم">
  <meta name="author" content="@DaSlackerHacker on twitter">
  <link rel="shortcut icon" href="/favicon.ico"> 
  
  <!-- FontAwesome JS-->
  <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
  
  <!-- Theme CSS -->
  <link id="theme-style" rel="stylesheet" href="/assets/css/theme-2.css">
  <link id="theme-style" rel="stylesheet" href="/assets/css/main.css">
  <link id="theme-style" rel="stylesheet" href="/assets/css/loading.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
  
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

  <!-- Load JQuery -->
  <script src="/assets/plugins/jquery-3.3.1.min.js"></script>

  <!-- Script for the text editor -->
  <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>

</head>

<body>

  <?php $index = 'active'; include 'header.php'; ?>
  
    <div class="container">
      <h1 class="font-weight-lighter d-flex justify-content-center">ماذا تريد ان تفعل؟</h1>
      <!-- Example row of columns -->
      <div class="row button-container">
        <div class="col-md-4">
          <p class="d-flex justify-content-center"><a class="btn btn-outline-primary btn-lg width-80" href="announcements" role="button">الاخبار</a></p>
        </div>
        <div class="col-md-4">
          <p class="d-flex justify-content-center"><a class="btn btn-outline-success btn-lg width-80" href="categories" role="button">الاقسام</a></p>
        </div>
        <div class="col-md-4">
          <p class="d-flex justify-content-center"><a class="btn btn-outline-danger btn-lg width-80" href="cards" role="button">الخدمات</a></p>
        </div>
      </div>
      <hr>
    </div> <!-- /container -->
  </main>
       
  <!-- Javascript -->
  <script src="/assets/plugins/popper.min.js"></script>
  <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
  <script src="/assets/js/main.js" activeHeaderLink="indexPage" id="main-script"></script>
  <script src="/assets/js/dashboard.js"></script>
</body>
</html>