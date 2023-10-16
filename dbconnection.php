<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "online_shop";

$mysqli = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected to the database : $database";
