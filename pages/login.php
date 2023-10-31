<?php
// Startsession
session_start();

// Check user logged in
if (isset($_SESSION["username"])) {
  header("Location: dashboard.php");
}

// Check if form is submitted
if (isset($_POST['login'])) {
  // Include database connection
  require_once "../dbconfig.php";
  $enteredUsername = $_POST["username"];
  $enteredPassword = $_POST["password"];

  // Prepare a select statement
  $sql = "SELECT * FROM users WHERE username = '$enteredUsername' AND password = '$enteredPassword'";
  $query = $mysqli->query($sql);
  $result = mysqli_fetch_array($query);

  if (is_array($result)) {
    $_SESSION["username"] = $enteredUsername;
    $_SESSION["password"] = $enteredPassword;
    header("Location: dashboard.php");
  } else {
    echo "Username atau password salah";
  }

  // Close connection
  $mysqli->close();
}

if (isset($_POST['register'])) {
  require_once "../dbconfig.php";
  $registerName = $_POST["register_name"];
  $registerEmail = $_POST["register_email"];
  $registerPhone = $_POST["register_phone"];
  $registerPassword = $_POST["register_password"];
  $groupId = 3;

  $sql_register = "INSERT INTO users (name, email, phone_number, username, password, group_id) VALUES ('$registerName', '$registerEmail', '$registerPhone', '$registerPhone', '$registerPassword', $groupId)";
  $query_register = $mysqli->query($sql_register);
  if ($query_register) {
    echo "<div class='alert alert-success' role='alert'>Berhasil register</div>";
  } else {
    echo "Gagal register";
  }
  // Close connection
  $mysqli->close();
}

if (isset($loginError)) {
  echo "<h2>$loginError</h2>";
}
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
            <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
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
            <button class="btn btn-default" data-dismiss="modal">Close</button>
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