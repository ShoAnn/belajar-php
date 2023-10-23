<?php

session_start();
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}

require_once "../../dbconfig.php";





?>



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

    <?php include "navbar.php" ?>
    <?php include "sidebar.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Products</h1>
            </div>
            <div class="col-sm-3">
              <a href="product-add.php"" class=" btn btn-success py-2 px-3">
                Tambah Produk
              </a>
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
            <form id="search-form">
              <div class="form-group row mx-1">
                <input type="text" id="search-input" class="form-control col-lg-9" placeholder="Search...">
                <button type="submit" class="form-control col-lg-3 bg-primary">Search</button>
              </div>
            </form>
            <div id="search-results" style="display: none;">
              <table class="table table-striped projects search">
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
              </table>
            </div>

            <table class="table table-striped projects listprod">
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
                    echo "<a href='javascript:void(0);' onclick='confirmDelete(" . $row['product_id'] . ")' title='Delete Record' data-toggle='tooltip'><span class='fas fa-trash p-2'></span></a>";
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
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script type="text/javascript">
    function confirmDelete(id) {
      if (confirm("Are you sure you want to delete this item?")) {
        window.location = "product-delete.php?id=" + id;
      } else {
        // If the user clicks "Cancel," do nothing
      }
    }

    document.getElementById('search-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const searchInput = document.getElementById('search-input').value;

      fetch('search.php', {
          method: 'POST',
          body: new URLSearchParams({
            searchQuery: searchInput
          }),
        })
        .then(response => response.json())
        .then(data => {
          const searchResults = document.getElementById('search-results');
          searchResults.style.display = 'block';

          const listprod = document.querySelector('.listprod');
          listprod.style.display = 'none';

          // get the search results div and empty it out if there are any elements
          const searchTable = document.querySelector('.search');
          let childNodes = searchTable.childNodes;
          let childNodesLength = childNodes.length;
          for (let i = childNodes.length - 1; i >= 0; i--) {
            searchTable.removeChild(childNodes[i]);
          }
          data.forEach(result => {
            let i = 1;
            const resultData = document.createElement('tr');
            resultData.innerHTML = `
                      <td>${i}</td>
                      <td>${result.product_id}</td>
                      <td>${result.product_name}</td>
                      <td>${result.category_id}</td>
                      <td>${result.product_code}</td>
                      <td>${result.description}</td>
                      <td>${result.price}</td>
                      <td>${result.unit}</td>
                      <td>${result.stock}</td>
                      <td>${result.image}</td>
                      <td>
                      <a href='product-edit.php?id=${result.product_id}' title='Update Record' data-toggle='tooltip'><span class='fas fa-edit p-2'></span></a>
                      <a href='javascript:void(0);' onclick='confirmDelete(${result.product_id})' title='Delete Record' data-toggle='tooltip'><span class='fas fa-trash p-2'></span></a>
                      </td>
                      `;
            i++;
            searchTable.appendChild(resultData);
          })
        });
    });
  </script>
</body>

</html>