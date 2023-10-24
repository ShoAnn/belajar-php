<?php

// Get the current page from the query string
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Define the number of items per page
$itemsPerPage = 5;

// Calculate the starting index for the database query
$startIndex = ($page - 1) * $itemsPerPage;

// Query the database for the data for the current page
$host = 'localhost';
$dbname = 'pos_shop';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM products LIMIT $startIndex, $itemsPerPage";
$result = $conn->query($sql);
$data = $result->fetchAll(PDO::FETCH_ASSOC);

// Calculate the total number of items in your table
$totalItems = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn();

// Create an array containing both the data for the current page and total number of items
$response = [
    'data' => $data,
    'totalItems' => $totalItems,
];

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
