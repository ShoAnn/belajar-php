<?php

session_start();
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}

require_once "../../dbconfig.php";

if (isset($_POST['add'])) {
  // Get the form data
  $product_name = $_POST["product_name"];
  $category_id = $_POST["category_id"];
  $code = $_POST["product_code"];
  $description = $_POST["description"];
  $price = $_POST["price"];
  $unit = $_POST["unit"];
  $stock = $_POST["stock"];
  $image = $_POST["image"];

  // Add product ke database
  $sql = "INSERT INTO products (product_name, category_id, product_code, description, price, unit, stock, image) VALUES ('$product_name', '$category_id', '$code', '$description', '$price', '$unit', '$stock', '$image')";
  if (mysqli_query($mysqli, $sql)) {
    echo "<div class='alert alert-success mb-0'> Added successfully </div>";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

$query_category = "SELECT * FROM product_categories";
$query_category_result = mysqli_query($mysqli, $query_category);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Produk</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php include "../pages/navbar.php" ?>
    <?php include "../pages/sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="row col-sm-6">
              <h1>Tambah Produk</h1>
              <a href="../pages/product-listing.php"" class=" mx-4 btn btn-primary py-2 px-3">
                Kembali ke Daftar Produk
              </a>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tambah Produk</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <form method="post" action="">
          <div class="row">
            <div class="col-md-6">
              <!-- card -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Tambah Produk</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="product_id">
                    <label for="product_name">Product Name:</label>
                    <input class="form-control" type="text" name="product_name">
                  </div>
                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="" class="form-control">
                      <?php

                      if (mysqli_num_rows($query_category_result) > 0) {
                        while ($category = mysqli_fetch_array($query_category_result)) {
                          echo "<option  value='" . $category['id'] . "'>" . $category['category_name'] . "</option>";
                        };
                      };
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="product_code">Code:</label>
                    <input class="form-control" type="text" name="product_code">
                  </div>
                  <div class="form-group">
                    <label for="description">Description:</label>
                    <input class="form-control" type="text" name="description">
                  </div>
                  <div class="form-group">
                    <label for="price">Price:</label>
                    <input class="form-control" type="text" name="price">
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <div class="col-md-6">
              <!-- card -->
              <div class="card">
                <div class="card-header">

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="unit">Unit:</label>
                    <input class="form-control" type="text" name="unit">
                  </div>
                  <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input class="form-control" type="text" name="stock">
                  </div>
                  <div class="form-group">
                    <label for="image">Image:</label>
                    <input class="form-control" type="text" name="image">
                  </div>
                  <div class="form-group">
                    <input class="form-control btn btn-success" name="add" type="submit" value="Tambah product">
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </form>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
</body>

</html>