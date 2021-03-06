<?php 
  session_start();
  include("function/koneksi.php");

  if(isset($_SESSION['id_user']) > 0) {
    header("location: dashboard_user.php");
  }

  if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = md5(htmlspecialchars($_POST['password']));

    $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      
      $_SESSION['id_user'] = $row['id_user'];
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['akses'] = $row['akses'];

      header("location: dashboard_user.php"); 
    } else {
      header("location: login_user.php?pesan=gagal");
    }
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="assets/templates/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/templates/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet" />

</head>

<body class="background">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-2 col-md-2">

        <div class="card border-0 shadow-lg my-5">
          <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900">Login User</h1>
                    <div class="garis-bawah mb-4"></div>
                  </div>

                  <?php 
                  if (isset($_GET['pesan'])) {
                      if($_GET['pesan']=="gagal"){
                        echo "<script type='text/javascript'>alert('Username atau Password salah!')</script>";
                    }else if($_GET['pesan'] == "logout"){
                        echo "<script type='text/javascript'>alert('Anda telah berhasil logout')</script>";
                    }else if($_GET['pesan'] == "belum_login"){
                        echo "<script type='text/javascript'>alert('Anda harus login terlebih dahulu')</script>";
                    }
                  }

                ?>
                  <form action="#" method="POST" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukan username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                    </div>
                  
                    <button class="btn btn-daftar btn-user btn-block" type="submit" name="login">Login</button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="register_user.php">Belum punya akun?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/templates/vendor/jquery/jquery.min.js"></script>
  <script src="assets/templates/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/templates/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/templates/js/sb-admin-2.min.js"></script>

</body>

</html>
