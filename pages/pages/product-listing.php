<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Products</title>

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
            <div class="col-sm-6">
              <h1>Projects</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Products</h3>
          </div>


          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Product id
                  </th>
                  <th>
                    Product Name
                  </th>
                  <th>
                    Category id
                  </th>
                  <th>
                    Code
                  </th>
                  <th>
                    Description
                  </th>
                  <th>
                    Price
                  </th>
                  <th>
                    Unit
                  </th>
                  <th>
                    Stock
                  </th>
                  <th>
                    Image
                  </th>
                  <th>
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php

                require_once "../../dbconfig.php";
                $query = "SELECT * FROM products";
                $result = mysqli_query($mysqli, $query);
                $i = 1;
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['category_id'] . "</td>";
                    echo "<td>" . $row['product_code'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['unit'] . "</td>";
                    echo "<td>" . $row['stock'] . "</td>";
                    echo "<td>" . $row['image'] . "</td>";
                    echo "<td>";
                    echo "<a href='product-edit.php?id=" . $row['product_id'] . "' title='Update Record' data-toggle='tooltip'><span class='fas fa-edit p-2'></span></a>";
                    echo "<a href='product-delete.php?id=" . $row['product_id'] . "' title='Delete Record' data-toggle='tooltip'><span class='fas fa-trash p-2'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                  }
                  echo "</table>";
                  // Free result set
                  mysqli_free_result($result);
                } else {
                  echo "<p class='lead'><em>No records were found.</em></p>";
                }

                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

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