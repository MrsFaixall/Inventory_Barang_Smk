<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="">
  <meta name="author" content="">
  <meta name="robots" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
  <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
  <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
  <meta property="og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
  <meta name="format-detection" content="telephone=no">

  <!-- PAGE TITLE HERE -->
  <title>Inventory login</title>

  <!-- FAVICONS ICON -->
  <link rel="shortcut icon" type="image/jpg" href="images/logo.png">
  <link href="css/style.css" rel="stylesheet">

  <style>
    .authincation {
      background: url('img/lib1.jpg') no-repeat center center;
      background-size: cover;
    }

    .footer-text {
      text-align: left;
    }
  </style>
</head>

<body class="vh-100">
  <div class="authincation h-100">
    <div class="container h-100">
      <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-6">
          <div class="authincation-content">
            <div class="row no-gutters">
              <div class="col-xl-12">
                <div class="auth-form">
                  <div class="text-center mb-3">
                    <a href="index.html"><img src="images/logo2.jpg" alt="" width="150px"></a>
                  </div>
                  <h4 class="text-center mb-4">Selamat Datang!</h4>
                  <form method="post">
                    <?php
                    if (isset($_POST['submit'])) {
                      $username = $_POST['username'];
                      $password = $_POST['password'];

                      $data = mysqli_query($koneksi, "SELECT * FROM user where username='$username'");
                      $user = mysqli_fetch_assoc($data);

                      if ($user && password_verify($password, $user['password'])) {
                        $_SESSION['user'] = $user;
                        echo '<script> alert("Selamat, login Berhasil"); location.href="index.php"; </script>';
                      } else {
                        echo '<script> alert("Login GAGAL"); </script>';
                      }
                    }
                    ?>
                    <div class="form-group mb-3">
                      <input type="text" name="username" id="inputUsername" class="form-control form-control-admin" required placeholder="Enter Username...">
                    </div>
                    <div class="form-group mb-3">
                      <input type="password" name="password" id="inputPassword" class="form-control form-control-admin" required placeholder="Password">
                    </div>

                    <button name="submit" value="submit" type="submit" class="btn btn-primary btn-user btn-block mb-3">
                      Login
                    </button>
                  </form>
                  <div class="text-center">
                    <p>&copy; 2024 BrotherRpl. All rights reserved.</p>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->
  <script src="vendor/global/global.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/dlabnav-init.js"></script>
  <script src="js/styleSwitcher.js"></script>
</body>

</html>