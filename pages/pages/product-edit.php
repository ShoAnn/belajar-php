<?php

session_start();
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}

require_once "../../dbconfig.php";
require "../../Product.php";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $product_id = $_POST["product_id"];
  $product_name = $_POST["product_name"];
  $category_id = $_POST["category_id"];
  $code = $_POST["product_code"];
  $description = $_POST["description"];
  $price = $_POST["price"];
  $unit = $_POST["unit"];
  $stock = $_POST["stock"];
  $image = $_POST["image"];

  // Update the data in the database
  $sql = "UPDATE products SET product_name='$product_name', category_id='$category_id', product_code='$code', description='$description', price='$price', unit='$unit', stock='$stock', image='$image' WHERE product_id='$product_id'";
  if (mysqli_query($mysqli, $sql)) {
    header("Location: product-listing.php");
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

// Get the product ID from the URL
$product_id = $_GET["id"];

// Get the data for the selected product from the database
$query_get_id = select('products', where: ['product_id' => $product_id]);

if (isset($_POST['addImage'])) {
}

$categories = select('product_categories');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Edit</title>

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
              <h1>Product Edit</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product Edit</li>
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
                  <h3 class="card-title">Informasi Produk</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="product_id" value="<?php echo $query_get_id[0]['product_id']; ?>">
                    <label for="product_name">Product Name:</label>
                    <input class="form-control" type="text" name="product_name" value="<?php echo $query_get_id[0]['product_name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control">
                      <?php
                      if (is_array($categories) || is_object($categories)) {
                        foreach ($categories as $category) {
                          if ($category['category_id'] == $query_get_id[0]['category_id']) {
                            echo "<option value='" . $category['category_id'] . "' selected>" . $category['category_name'] . "</option>";
                          } else {
                            echo "<option value='" . $category['category_id'] . "'>" . $category['category_name'] . "</option>";
                          }
                        }
                      };
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="product_code">Code:</label>
                    <input class="form-control" type="text" name="product_code" value="<?php echo $query_get_id[0]['product_code']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="description">Description:</label>
                    <input class="form-control" type="text" name="description" value="<?php echo $query_get_id[0]['description']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="price">Price:</label>
                    <input class="form-control" type="text" name="price" value="<?php echo $query_get_id[0]['price']; ?>">
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
                    <input class="form-control" type="text" name="unit" value="<?php echo $query_get_id[0]['unit']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input class="form-control" type="text" name="stock" value="<?php echo $query_get_id[0]['stock']; ?>">
                  </div>
                  <div class="form-group">
                    <button type="button" class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#editImage_modal">
                      <b>Edit Product Image</b>
                    </button>
                  </div>
                  <div class="form-group">
                    <input class="form-control btn btn-success" name="update" type="submit" value="Update">
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </form>
        <!-- /.card-body -->
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

  </div>
  <!-- ./wrapper -->

  <!--Edit Image Modal -->
  <div class="modal fade" id="editImage_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Images</h4>
        </div>

        <div class="modal-body">
          <div class="row">
            <?php
            $images = select('products', col: 'image', where: ['product_id' => $product_id]);
            if (!empty($images)) {
              foreach ($images as $image) {
                $path = $image['image'] ?? '';
                if (strpos($path, ',') !== false) {
                  $all_img_path = str_replace(array('[', ']', '"'), '', $path);
                  $img_paths = explode(",", $all_img_path);
                  foreach ($img_paths as $img) {
                    echo "<img class='img-thumbnail' src='" . $img . "' alt=''>";
                  };
                } elseif (!empty($path) && strpos($path, ',') == false) {
                  $img_path = str_replace(array('[', ']', '"'), '', $path);
                  echo "<img class='img-thumbnail' src='" . $img_path . "' alt=''>";
                } else {
                  echo " <span class='col mb-3 text-center'>No image</span>";
                }

                // echo "<div class='col-md-3'>";
                // echo "<img src='../../" . $image['image'] . "' class='img-fluid mb-2' alt='white sample'/>";
                // echo "<button type='button' class='btn btn-block btn-outline-danger' onclick='deleteImage(" . $image['image_id'] . ")'>Delete</button>";
                // echo "</div>";
              }
            }
            ?>
            <form action="" method="POST">
              <div class="form-group">
                <label for="image" class="form-label">Add Image</label>
                <input type="file" class="form-control" name="image" id="image" multiple>
              </div>
              <button type="submit" name="addImage" class="add-image-btn btn btn-primary form-control"><i class="fas fa-plus"></i> Upload</button>
            </form>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-success" data-dismiss="modal">Selesai</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- end modal -->

  <!-- script edit images -->
  <script>
    // addData function in the PHP file
    const addBtn = document.querySelector('.add-image-btn');
    const searchParams = new URLSearchParams(window.location.search);
    const idProduct = searchParams.get('id');
    console.log(idProduct);
    addBtn.addEventListener('click', addImage(idProduct));

    function addImage(id) {
      fetch('../../Product.php?action=addImage', {
          method: 'POST',
          body: JSON.stringify(data),
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then(response => response.json())
        .then(data => {
          // Handle the response
        });
    }

    // Function to delete data
    function deleteImage(id) {
      fetch('../../Product.php?action=deleteImage', {
          method: 'POST',
          body: JSON.stringify({
            id: id
          }),
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then(response => response.json())
        .then(data => {
          // Update the UI to remove the deleted data
          // Example: remove the item from a list
        });
    }
  </script>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>

</body>

</html>