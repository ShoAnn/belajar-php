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



?>

<?php
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
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Log In</button>
          </div>
        </form>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
</body>

</html>