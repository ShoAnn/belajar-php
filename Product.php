<?php

use LDAP\Result;

class Product
{
    public $productId;
    public $productName;
    public $categoryId;
    public $code;
    public $description;
    public $price;
    public $unit;
    public $stock;
    public $image;

    public function addProduct($product_name, $category_id, $code, $description, $price, $unit, $stock, $image)
    {
        $this->productName = $product_name;
        $this->categoryId = $category_id;
        $this->code = $code;
        $this->description = $description;
        $this->price = $price;
        $this->unit = $unit;
        $this->stock = $stock;
        $this->image = $image;

        $filePaths = [];
        if (!empty($this->image['name'][0])) {
            $uploadDir = "uploads/"; // Directory to store uploaded files

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Loop through the uploaded files
            foreach ($this->image['name'] as $key => $filename) {
                $tempFile = $this->image['tmp_name'][$key];
                $targetFile = $uploadDir . basename($filename);

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($tempFile, $targetFile)) {
                    $filePaths[] = $targetFile;
                } else {
                    echo "Error uploading file " . $filename;
                }
            }
        }

        // Convert the file paths to JSON
        $jsonFilePaths = json_encode($filePaths);

        // Store the JSON data in the database
        require "dbconfig.php";

        $stmt = $mysqli->prepare("INSERT INTO products (product_name, category_id, product_code, description, price, unit, stock, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissssis", $this->productName, $this->categoryId, $this->code, $this->description, $this->price, $this->unit, $this->stock, $jsonFilePaths);
        if ($stmt->execute()) {
            $stmt->close();
            $mysqli->close();
            return true;
        } else {
            $stmt->close();
            $mysqli->close();
            return false;
        }
    }
}

function show($table, $numData = null, $startIndex = null, $where = null)
{
    require "dbconfig.php";
    $query = "SELECT * FROM $table";
    if ($where !== null) {
        foreach ($where as $key => $value) {
            $query .= " WHERE $key=$value";
        }
    }
    if ($numData !== null && $startIndex !== null) {
        $query .= " LIMIT $numData OFFSET $startIndex";
    }


    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $records = [];
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }

        $mysqli->close();

        return $records;
    } else {
        $mysqli->close();
        return [];
    }
}
