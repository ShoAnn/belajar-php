<?php
session_start();


if (isset($_SESSION["username"])) {
    header("Location: pages/dashboard.php");
} else {
    header("Location: pages/login.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Fundamentals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <header>
        <h2 class="bg-dark text-white bg-gradient w100 px-3 py-3">PHP Fundamentals</h2>
    </header>
    <div class="container-fluid row">
        <h2></h2>
        <aside class="col-lg-3">
            <div class="card">
                <div class="card-header">Menu</div>
                <div class="card-body">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/dashboard.php">Dashboard</a>
                            <a class="nav-link" href="index.php">Home</a>
                            <a class="nav-link" href="pages/login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <main class="col-lg-9">
            <?php
            // 1. Variable and Data Type
            $name = "John Doe";
            $age = 30;
            $isStudent = true;

            // 2. Output
            echo "
                <div class='card'>
                    <div class='card-header'>Variabel dan tipe data</div>
                    <div class='card-body'>
                        <p>Halo nama saya, $name!</p>
                        <p>Umur saya, $age</p>
                        <p>Status mahasiswa : $isStudent</p>
                    </div>
                </div>
            ";

            // 3. Conditional Statements
            echo "
            <div class='card mt-3'>
                <div class='card-header'>If else</div>
                <div class='card-body'>
            ";
            if ($age >= 20) {
                echo "<p>Kamu sudah dewasa</p>";
            } else {
                echo "<p>Kamu belum dewasa</p>";
            }

            echo "
                </div>
            </div>
            
            <div class='card mt-3'>
                <div class='card-header'>Loop/Iterasi</div>
                <div class='card-body'>
            ";

            // 4. Loops
            echo "<ul>";
            for ($i = 1; $i <= 5; $i++) {
                echo "<li>Item $i</li>";
            }
            echo "</ul>";

            echo "
                </div>
            </div>
            
            <div class='card mt-3'>
                <div class='card-header'>Array</div>
                <div class='card-body'>
            ";
            // 5. Arrays
            $colors = array("Red", "Green", "Blue");
            echo "<p>Colors: " . implode(", ", $colors) . "</p>";

            echo "
                </div>
            </div>

            <div class='card mt-3'>
                <div class='card-header'>Function</div>
                <div class='card-body'>
            ";

            // 6. Functions
            function add($a, $b)
            {
                return $a + $b;
            }
            $result = add(5, 3);
            echo "<p>5 + 3 = $result</p>";
            echo "
                </div>
            </div>
            ";

            // 9. Error Handling
            // Uncomment the following line to trigger a division by zero error.
            // $result = 10 / 0;
            ?>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>


</html>