<?php

session_start();
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}

require_once "../../dbconfig.php";
require "../../Product.php";

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


            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th>Product id</th>
                  <th>Product Name</th>
                  <th>Category id</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Unit</th>
                  <th>Stock</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>

              <div id="search-results" style="display: none;">
                <tbody class="search">
                </tbody>
              </div>

              <tbody class="listprod">
                <?php

                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $rowPerPage = 5;
                $startIndex = ($page - 1) * $rowPerPage;
                $listing = select('products', numData: $rowPerPage, startIndex: $startIndex);
                if (!empty($listing)) {
                  foreach ($listing as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['product_id'] . "</td>";
                    echo "<td>" . $value['product_name'] . "</td>";
                    echo "<td>" . $value['category_id'] . "</td>";
                    echo "<td>" . $value['product_code'] . "</td>";
                    echo "<td>" . $value['description'] . "</td>";
                    echo "<td>" . $value['price'] . "</td>";
                    echo "<td>" . $value['unit'] . "</td>";
                    echo "<td>" . $value['stock'] . "</td>";
                    echo "<td>";
                    if (!empty($value['image'])) {
                      $path = json_decode($value['image']);
                      foreach ($path as $img) {
                        echo "<img class='img-thumbnail' src='" . $img . "' alt=''>";
                      };
                    } else {
                      echo "No Image";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='product-edit.php?id=" . $value['product_id'] . "' title='Update Record' data-toggle='tooltip'><span class='fas fa-edit p-2'></span></a>";
                    echo "<a href='javascript:void(0);' onclick='confirmDelete(" . $value['product_id'] . ")' title='Delete Record' data-toggle='tooltip'><span class='fas fa-trash p-2'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                } else {
                  echo "<p class='lead'><em>No records were found.</em></p>";
                }

                ?>
              </tbody>
            </table>
            <div class="card-footer">
              <ol class="pagination">

                <?php
                $query_all = select('products');
                $total_records = count($query_all);
                $total_pages = ceil($total_records / $rowPerPage);
                for ($i = 1; $i <= $total_pages; $i++) {
                  echo "<li class='page-item'><a class='page-link' href='product-listing.php?page=" . $i . "'>" . $i . "</a></li>";
                }
                ?>

              </ol>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- categories box -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <h4>Produk Berdasarkan Kategori</h4>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="card col-md-4">
                <div class="card-header">
                  <h4 class="card-title">Sports</h4>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                      </tr>
                    </thead>
                    <?php
                    $query_view_sports = select('category_sports');

                    if (count($query_view_sports) > 0) {
                      foreach ($query_view_sports as $value) {
                        echo "<tr>";
                        echo "<td>" . $value['product_id'] . "</td>";
                        echo "<td>" . $value['product_name'] . "</td>";
                        echo "</tr>";
                      };
                      echo "<tr>";
                      echo "<td><strong>Total</strong></td>";
                      echo "<td>" . count($query_view_sports) . "</td>";
                      echo "</tr>";
                    };
                    ?>
                  </table>
                </div>
              </div>
              <div class="card col-md-4">
                <div class="card-header">
                  <h4 class="card-title">Daily</h4>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                      </tr>
                    </thead>
                    <?php
                    $query_view_daily = select('category_daily');

                    if (count($query_view_daily) > 0) {
                      foreach ($query_view_daily as $value) {
                        echo "<tr>";
                        echo "<td>" . $value['product_id'] . "</td>";
                        echo "<td>" . $value['product_name'] . "</td>";
                        echo "</tr>";
                      };
                      echo "<tr>";
                      echo "<td><strong>Total</strong></td>";
                      echo "<td>" . count($query_view_daily) . "</td>";
                      echo "</tr>";
                    };
                    ?>
                  </table>
                </div>
              </div>
              <div class="card col-md-4">
                <div class="card-header">
                  <h4 class="card-title">Accessories</h4>
                </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                      </tr>
                    </thead>
                    <?php
                    $query_view_accessories = select('category_accessories');

                    if (count($query_view_accessories) > 0) {
                      foreach ($query_view_accessories as $value) {
                        echo "<tr>";
                        echo "<td>" . $value['product_id'] . "</td>";
                        echo "<td>" . $value['product_name'] . "</td>";
                        echo "</tr>";
                      };
                      echo "<tr>";
                      echo "<td><strong>Total</strong></td>";
                      echo "<td>" . count($query_view_accessories) . "</td>";
                      echo "</tr>";
                    };
                    ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
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

    // search
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

    // end search

    // pagination
    // Create a URLSearchParams object from the current URL
    const searchParams = new URLSearchParams(window.location.search);

    // Get specific parameters
    const page = searchParams.get('page') || '1';
    const pageContainer = document.querySelector('.pagination');
    const nthpage = pageContainer.children[parseInt(page) - 1];
    nthpage.classList.add('active');

    const dataPerPage = 5;
    let currentPage = 1;
    // end pagination
  </script>
</body>

</html>