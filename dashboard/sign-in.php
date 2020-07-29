
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Signin Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link id="theme-style" rel="stylesheet" href="/assets/css/theme-2.css">
    <meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.arabic {
  direction: rtl;
}

.arabic-text::placeholder {
  text-align: right;
}

.arabic-text {
  text-align: right;
}
    </style>
    <!-- Custom styles for this template -->
    <!-- <link href="signin.css" rel="stylesheet"> -->
</head>
<body class="text-center">
  <form class="form-signin" action="../php/signin.php" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">تسجيل الدخول</h1>
    <label for="inputEmail" class="sr-only">البريد الالكتروني</label>
    <input type="text" name="user" id="inputEmail" class="form-control arabic-text" placeholder="اسم المستخدم" required autofocus>
    <label for="inputPassword" class="sr-only">كلمة السر</label>
    <input type="password" name="password" id="inputPassword" class="form-control arabic-text" placeholder="كلمة السر" required>
    <div class="checkbox mb-3">
      <input name="remember" hidden type="checkbox" value="1" id="remember">
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">الدخول</button>
    <p class="mt-5 mb-3 text-muted"></p>
    <span id="msg">
      <!-- <div class="alert alert-danger" role="alert">
        A simple danger alert—check it out!
      </div> -->
    </span>
  </form>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="/assets/js/main.js?v=11" activeHeaderLink="indexPage" id="main-script"></script>
  <script>
    if (findGetParameter("e") !== null) {
      if (findGetParameter("e") === "invalid") {
        $("#msg").html(`<div class="alert alert-danger" role="alert">البريد الإلكتروني أو كلمة السر خاطئة</div>`);
      }
    }
    if (findGetParameter("user") !== null) {
      $("#inputEmail").val(findGetParameter("user"));
    }

    if (findGetParameter("remember") !== null) {
      $("#remember").attr("checked", true);
    }
  </script>
</body>
</html>
