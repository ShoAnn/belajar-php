
<?php
// Database connection setup (you'll need to fill in your database details)
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchQuery = $_POST['searchQuery'];

    // Prepare and execute the database query
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE :query");
    $stmt->execute(['query' => '%' . $searchQuery . '%']);

    // Fetch results as an associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return results as JSON
    header('Content-Type: application/json');
    echo json_encode($results);
}
