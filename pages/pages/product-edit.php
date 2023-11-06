<?php

session_start();
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
}


require_once "../../dbconfig.php";
require "../../Product.php";


if (isset($_POST['addImage'])) {
  $product_id = $_GET['id'];
  $img = $_FILES["images"];

  $product = new Product;
  $updateImageResult = $product->updateImage($product_id, $img);
  if ($updateImageResult) {
    echo "<div class='alert alert-primary'>Image added successfully!</div>";
  } else {
    echo "Image failed to add. Please try again.";
  }
}

if (isset($_POST['update'])) {
  // Get the form data
  $product_id = $_POST["product_id"];
  $product_name = $_POST["product_name"];
  $category_id = $_POST["category_id"];
  $code = $_POST["product_code"];
  $description = $_POST["description"];
  $price = $_POST["price"];
  $unit = $_POST["unit"];
  $stock = $_POST["stock"];

  // Update the data in the database
  $sql = "UPDATE products SET product_name='$product_name', category_id='$category_id', product_code='$code', description='$description', price='$price', unit='$unit', stock='$stock', WHERE product_id='$product_id'";
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
                  <div class="card">
                    <div class="card-header"><b>Image</b></div>
                    <div class="card-body row">
                      <?php
                      $images = select('products', col: 'image', where: ['product_id' => $product_id]);
                      if (!empty($images)) {
                        foreach ($images as $image) {
                          $path = json_decode($image['image']);
                          if (!empty($path)) {
                            foreach ($path as $img) {
                              echo "<div class='col-md-2 p-1'>";
                              echo "<img src='" . $img . "' class='img-fluid img-thumbnail' alt='sample'/>";
                              echo "</div>";
                            }
                          } else {
                            echo '<span >No Image</span>';
                          }
                        }
                      } else {
                        echo '<span >No Image</span>';
                      }
                      ?>
                    </div>
                    <div class="card-footer pt-0">
                      <button type="button" class="btn btn-block btn-outline-dark" data-toggle="modal" data-target="#editImage_modal">
                        <b>Tambah/Hapus Image</b>
                      </button>
                    </div>
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
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Images</h4>
        </div>

        <div class="modal-body overflow-auto">
          <div class="row img_listing">
            <?php
            $images = select('products', col: 'image', where: ['product_id' => $product_id]);
            if (!empty($images)) {
              foreach ($images as $image) {
                $path = json_decode($image['image']);
                if (!empty($path)) {
                  foreach ($path as $img) {
                    echo "<div class='col-md-2 p-1'>";
                    echo "<img src='" . $img . "' class='img-fluid img-thumbnail h-75' style='object-fit: cover;' alt='image'/>";
                    echo "<a href='javascript:void(0);' class='btn btn-block btn-outline-danger' onclick='deleteImage(" . $product_id . ", " . htmlspecialchars(json_encode($img), ENT_QUOTES, 'UTF-8') . ")'>Delete</a>";
                    echo "</div>";
                  }
                } else {
                  echo '<span class="w-100 text-center py-3">No Image</span>';
                }
              }
            } else {
              echo '<span class="w-100 text-center">No Image</span>';
            }
            ?>
          </div>
          <div class="col-md-8 mx-auto py-2">
            <hr>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group row align-items-center">
                <label class="form-label col-4" for="image">Tambah gambar</label>
                <input type="file" class="form-control col-5" name="images[]" multiple="multiple">
                <input class="form-control btn btn-success col-3" name="addImage" type="submit" value="Tambah image">
              </div>
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
    // Function to delete data
    function deleteImage(id, img) {
      fetch('delete-img.php', {
          method: 'POST',
          body: JSON.stringify({
            id: id,
            img: img
          }),
          headers: {
            'Content-Type': 'application/json',
          },
        })
        .then(response => response.json())
        .then(data => {
          // Update the UI to remove the deleted data
          // Example: remove the item from a list
          const imgListing = document.querySelector('.img_listing');
          console.log(data);
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