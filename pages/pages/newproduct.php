<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | General UI</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <style>
        .color-palette {
            height: 35px;
            line-height: 35px;
            text-align: right;
            padding-right: .75rem;
        }

        .color-palette.disabled {
            text-align: center;
            padding-right: 0;
            display: block;
        }

        .color-palette-set {
            margin-bottom: 15px;
        }

        .color-palette span {
            display: none;
            font-size: 12px;
        }

        .color-palette:hover span {
            display: block;
        }

        .color-palette.disabled span {
            display: block;
            text-align: left;
            padding-left: .75rem;
        }

        .color-palette-box h4 {
            position: absolute;
            left: 1.25rem;
            margin-top: .75rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            display: block;
            z-index: 7;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="pages/newproduct.php" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Product List (tugas)
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../dashboard.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Daftar Produk</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Daftar Produk</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <h1>Aircraft Data</h1>

                    <?php
                    $cardData = [
                        [
                            "name" => "Chengdu J-20",
                            "imgPath" => "../../assets/images/Chengdu J-20.jpg",
                            "desc" => "The Chengdu J-20, also known as Mighty Dragon, is a twinjet all-weather stealth fighter aircraft developed by China's Chengdu Aerospace Corporation for the People's Liberation Army Air Force. The J-20 is designed as an air superiority fighter with precision strike capability. Wikipedia",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ],
                        [
                            "name" => "F-35 Lightning II",
                            "imgPath" => "../../assets/images/f35_lightning_II.jpg",
                            "desc" => "The Lockheed Martin F-35 Lightning II is an American family of single-seat, single-engine, all-weather stealth multirole combat aircraft that is intended to perform both air superiority and strike missions. It is also able to provide electronic warfare and intelligence, surveillance, and reconnaissance capabilities.",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ],
                        [
                            "name" => "F-22 Raptor",
                            "imgPath" => "../../assets/images/f22_raptor.jpg",
                            "desc" => "The Lockheed Martin F-22 Raptor is an American single-seat, twin-engine, supersonic all-weather stealth fighter aircraft developed for the United States Air Force. Wikipedia",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ],
                        [
                            "name" => "Sukhoi Su-57",
                            "imgPath" => "../../assets/images/Sukhoi Su-57.jpg",
                            "desc" => "The Sukhoi Su-57 is a twin-engine stealth multirole fighter aircraft developed by Sukhoi. It is the product of the PAK FA programme, which was initiated in 1999 as a more modern and affordable alternative to the MFI. Sukhoi's internal designation for the aircraft is T-50. Wikipedia",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ],
                        [
                            "name" => "Boeing X-53 Active Aeroelastic Wing",
                            "imgPath" => "../../assets/images/Boeing X-53 Active Aeroelastic Wing.jpg",
                            "desc" => "The X-53 Active Aeroelastic Wing development program is a completed American research project that was undertaken jointly by the Air Force Research Laboratory, Boeing Phantom Works and NASA's Dryden Flight Research Center, where the technology was flight tested on a modified McDonnell Douglas F/A-18 Hornet. Wikipedia",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ],
                        [
                            "name" => "Eurofighter Typhoon",
                            "imgPath" => "../../assets/images/Eurofighter Typhoon.jpg",
                            "desc" => "The Eurofighter Typhoon is a European multinational twin-engine, canard delta wing, multirole fighter.[3][4] The Typhoon was designed originally as an air-superiority fighter[5] and is manufactured by a consortium of Airbus, BAE Systems and Leonardo that conducts the majority of the project through a joint holding company, Eurofighter Jagdflugzeug GmbH. The NATO Eurofighter and Tornado Management Agency, representing the UK, Germany, Italy and Spain, manages the project and is the prime customer.[6]",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ],
                        [
                            "name" => "General Dynamics F-16 Fighting Falcon",
                            "imgPath" => "../../assets/images/General Dynamics F-16 Fighting Falcon.jpg",
                            "desc" => "The General Dynamics F-16 Fighting Falcon is an American single-engine supersonic multirole fighter aircraft originally developed by General Dynamics for the United States Air Force. Designed as an air superiority day fighter, it evolved into a successful all-weather multirole aircraft. Wikipedia",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ],
                        [
                            "name" => "Sukhoi Su-34",
                            "imgPath" => "../../assets/images/Sukhoi Su-34.jpg",
                            "desc" => "The Sukhoi Su-34 is a Soviet-origin Russian twin-engine, twin-seat, all-weather supersonic medium-range fighter-bomber/strike aircraft. It first flew in 1990, intended for the Soviet Air Forces, and it entered service in 2014 with the Russian Air Force. Wikipedia",
                            "harga" => "$" . strval(rand(150, 250) * 1000000)

                        ]
                    ];



                    // Loop through the PHP array and display the data
                    foreach ($cardData as $item) {
                        echo "<div class='card'>";
                        echo "<div class='card-header'><h3>" . $item['name'] . "</h3></div>";
                        echo "<div class='card-body'><img class='img-thumbnail' src='" . $item['imgPath'] . "' alt='" . $item['name'] . "' /><p>" . $item['desc'] . "</p><p>Harga : " . $item['harga'] . "</p></div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</body>

</html>