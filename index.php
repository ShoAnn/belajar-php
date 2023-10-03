<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Fundamentals</title>
</head>
<body>
    <h1>PHP Fundamentals</h1>

    <?php
    // 1. Variables and Data Types
    $name = "John Doe";
    $age = 30;
    $isStudent = true;
    
    // 2. Output
    echo "<p>Hello, $name!</p>";
    
    // 3. Conditional Statements
    if ($age >= 18) {
        echo "<p>You are an adult.</p>";
    } else {
        echo "<p>You are a minor.</p>";
    }
    
    // 4. Loops
    echo "<ul>";
    for ($i = 1; $i <= 5; $i++) {
        echo "<li>Item $i</li>";
    }
    echo "</ul>";
    
    // 5. Arrays
    $colors = array("Red", "Green", "Blue");
    echo "<p>Colors: " . implode(", ", $colors) . "</p>";
    
    // 6. Functions
    function add($a, $b) {
        return $a + $b;
    }
    $result = add(5, 3);
    echo "<p>5 + 3 = $result</p>";
    
    // 7. Super Globals
    echo "<p>Server IP: " . $_SERVER['SERVER_ADDR'] . "</p>";
    
    // 8. File Handling
    $file = fopen("example.txt", "r");
    if ($file) {
        $contents = fread($file, filesize("example.txt"));
        fclose($file);
        echo "<p>File Content: $contents</p>";
    } else {
        echo "<p>Error reading the file.</p>";
    }
    
    // 9. Error Handling
    // Uncomment the following line to trigger a division by zero error.
    // $result = 10 / 0;
    ?>
</body>
</html>
