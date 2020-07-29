<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="/" target="_blank">الرجوع الى الموقع</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse arabic-text arabic" id="navbarsExampleDefault">
    <hr>
    <ul class="navbar-nav mr-auto d-flex width-80">
      <li class="nav-item <?php echo (isset($index) ? $index : ""); ?>">
        <a class="nav-link" href="/dashboard/">لوحة التحكم <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php echo (isset($announcements) ? $announcements : ""); ?>">
        <a class="nav-link" href="announcements">الاخبار</a>
      </li>
      <li class="nav-item <?php echo (isset($categories) ? $categories : ""); ?>">
        <a class="nav-link" href="categories">الاقسام</a>
      </li>
      <li class="nav-item <?php echo (isset($services) ? $services : ""); ?>">
        <a class="nav-link" href="cards">الخدمات</a>
      </li>
      <li class="nav-item <?php echo (isset($main) ? $main : ""); ?>">
        <a class="nav-link" href="main">الموقع</a>
      </li>
      <div class="col-sm-3"></div>
      <br>
      <li class="nav-item"><a class="nav-link" href="logout">تسجيل الخروج</a></li>
    </ul>
  </div>
</nav>

<main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <br>
      <h1 class="display-4 justify-content-center d-flex">مرحبا بك في لوحة التحكم</h1>
      <br>
      <p class="text-center">هنا يمكنك تعديل, إنشاء أو حذف اقسام أو خدمات أو أخبار</p>
    </div>
  </div>