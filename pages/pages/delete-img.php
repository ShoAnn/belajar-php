<?php
require "../../Product.php";

$id = $_POST['id'];
$img = $_POST['img'];
if (deleteImage($id, $img)) {
    $result = select("products", 'image', null, null, ["product_id" => $id]);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Image deleted successfully.', 'images' => $result[0]['image']]);
    } else {
        echo json_encode(['error' => 'Error deleting image. Please try again.']);
    }
}
