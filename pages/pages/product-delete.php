<?php
require_once "../../dbconfig.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE product_id = $id";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: product-listing.php");
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
}
