<?php
include "../User.php";

// Check user logged in
if (isset($_SESSION["username"])) {
  header("Location: dashboard.php");
};



// Check if form is submitted
if (isset($_POST['login'])) {
  $loginUsername = $_POST["username"];
  $loginPassword = $_POST["password"];

  // Prepare a select statement
  $user = new User;
  $loggedIn = $user->login($loginUsername, $loginPassword);

  if ($loggedIn) {
    // Redirect to a secure page
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Login failed. Please try again.";
  }
};

if (isset($_POST['register'])) {
  require_once "../User.php";
  $name = $_POST["register_name"];
  $phone = $_POST["register_phone"];
  $email = $_POST["register_email"];
  $username = $_POST["register_phone"];
  $password = $_POST["register_password"];
  $group = 3;

  $user = new User;
  $result = $user->register($name, $phone, $email, $group, $username, $password);

  if ($result) {
    echo "<div class='alert alert-primary'>Registration successful!</div>";
  } else {
    echo "Registration failed. Please try again.";
  }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Admin</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="username" name="username" required placeholder="Nomor HP">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="col">
            <button type="submit" name="login" class="btn btn-primary btn-block">Log In</button>
            <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#modalReg">
              <b>Register Admin</b>
            </button>
          </div>
        </form>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <!-- modal register -->

  <div class="modal fade" id="modalReg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Register</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="register_name" class="form-label">Nama</label>
              <input type="text" name="register_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="register_email" class="form-label">Email</label>
              <input type="text" name="register_email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="register_phone" class="form-label">Nomor HP</label>
              <input type="text" name="register_phone" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="register_password" class="form-label">Password</label>
              <input type="text" name="register_password" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="submit" name="register" class="btn btn-primary">Register Admin</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- end modal register -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <script src="../../plugins/toastr/toastr.min.js"></script>
</body>

</html>