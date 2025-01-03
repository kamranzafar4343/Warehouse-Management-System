<?php

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: pages-login.php");
    exit();
}

// Include the database connection
include 'config/db.php';

// Get user email from session
$email = $_SESSION['email'];

// Get user name and email from register table
$getAdminData = "SELECT * FROM register WHERE email = '$email' ORDER BY id DESC";
$resultData = mysqli_query($conn, $getAdminData);
if ($resultData->num_rows > 0) {
    $row2 = $resultData->fetch_assoc();
    $adminName = $row2['name'];
    $adminEmail = $row2['email'];
}

//select all columns of boxes 
$sql = "SELECT * FROM box";
$result = $conn->query($sql);


if (isset($_GET['comp_id'])) {
    $comp_id = $_GET['comp_id'];
    $sql = "SELECT * FROM box WHERE companiID_FK = '$comp_id'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Racks</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="assets/img/dtl.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Custom CSS to decrease font size of the table */

        /* Basic styling for search bar */
        input.btn.btn-success {
            margin-left: 7px;
            height: 41px;
            padding: 2%;
            padding-top: 3px;
            padding-bottom: 3px;
            text-align: center;
            justify-items: center;

        }

        .search-container {
            margin: 50px;
            margin-left: 320px;
            margin-bottom: 3px !important;
        }

        #main {

            margin-top: 0 !important;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 0.9rem;
            width: 363px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
        }

        .pagetitle {
            display: flex;
            width: 989px;
            flex-direction: column;

        }

        .barcode {
            height: 55px;
            width: 250px;
            position: relative;
            left: -38px;
        }

        /* 
        #main {
            margin-top: 20px !important;
            padding: 20px 30px;
            transition: all 0.3s;
        } */

        .row {
            margin-left: 52px;
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)* -1);
            margin-right: calc(var(--bs-gutter-x)* 1.5);
            margin-left: calc(var(--bs-gutter-x)* 0.2);
        }

        .datatable-container {
            border: none;
            margin-left: 12px;
            margin-top: 12px;
            /* table-layout: fixed; */
        }


        /* Define the pulse animation */
        .pagetitle {
            display: flex;
            width: 989px;
            flex-direction: column;

        }

        #fixedButtonBranch {
            position: relative;
            top: 18px;
            left: -2px;
        }

        .row {
            margin-left: 52px;
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(var(--bs-gutter-y)* -1);
            margin-right: calc(var(--bs-gutter-x)* 1.5);
            margin-left: calc(var(--bs-gutter-x)* 0.2);
        }

        .datatable-container {
            border: none;
            margin-left: 12px;
            margin-top: 12px;
            /* table-layout: fixed; */
        }

        .card-body {
            padding: 0 20px 20px 60px !important;
        }


        /* Define the pulse animation */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Define the click animation */
        @keyframes clickEffect {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(0.9);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .company-name {
            color: #000;
            text-decoration: none;
            display: inline-block;
            transition: color 0.3s ease;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
            margin-right: 214px;
        }

        .datatable-dropdown label {
            font-size: 0.9rem;
        }

        .datatable-info {
            display: none;
        }

        .datatable-top {
            width: 942px;

        }

        /* Card */
        .cardBranch {
            margin-bottom: 30px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
            background-color: white;
            font-size: 0.8rem;

        }

        .company-name:active {
            animation: clickEffect 0.s ease;
            /* Apply the click effect animation on click */
            color: #0056b3;
            /* Darken color on click */
        }

        * {
            margin: 0;

            padding: 0;

            box-sizing: border-box;
        }

        .custom2 {
            font-size: 0.8rem;
            border-radius: 7px;
            padding-top: 14px;
            padding-bottom: 14px;
            padding-right: 34px;
            padding-left: 40px;
            margin-left: 20px;
        }

        tbody,
        td,
        tr {
            word-wrap: break-word;
            max-width: 200px;
        }

        .datatable-table>tbody>tr>td,
        .datatable-table>tbody>tr>th,
        .datatable-table>tfoot>tr>td,
        .datatable-table>tfoot>tr>th,
        .datatable-table>thead>tr>td,
        .datatable-table>thead>tr>th {
            vertical-align: top;
            padding: 8px 2px;
        }

        .image-circle {
            display: flex;
            justify-content: center;
            /* Horizontally center */
            align-items: center;
            text-align: center;
        }


        .navbar-image {
            width: 50px;
            height: 50px;
            margin-right: 7px;
        }

        .headerbox {

            display: flex;
        }

        .datatable-table>thead>tr>th {
            vertical-align: bottom;
            text-align: left;
            border-bottom: 0px solid #d9d9d9;
        }

        .pagetitleinside button {
            width: 150px;
        }

        .datatable-pagination {
            margin-left: 50px;
        }

        .drpdwn {
            margin-left: 268px;
            max-width: 424px;
            margin-top: 28px;
        }
    </style>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <img class="navbar-image" src="assets/img/dtl.png" alt="">

            <a href="index.php" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block"></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->


                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3 mr-4">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="image/admin-png.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $adminName ?></span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $adminName ?></h6>
                            <span><?php echo $adminEmail ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                </li>

            </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <?php
    include "config/db.php";

    $role = $_SESSION['role'];
    ?>

    <!-- sidebar start -->
    <?php
    include "sidebarcode.php";
    ?>
    <!-- sidebar end -->

    <!-- Main content -->
    <main id="main" class="main">
        <div class="mt-4">
            <br>
        </div>
        <div class="col-12">
            <div class="cardBranch recent-sales overflow-auto mt-5">
                <div class="card-body">

                    <!-- Title and Add Button -->
                    <div class="row mb-3">
                        <div class="col-6">
                            <h5 class="card-title">Search Racks</h5>
                        </div>
                        <div class="col-6 text-end">
                            <button id="fixedButtonBranch" type="button" onclick="window.location.href = 'createRack.php'" class="btn btn-primary">Add Rack</button>
                        </div>
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="" class="row g-3 mb-3">

                        <!-- First Row: Column and Search Value -->
                        <div class="col-md-4">
                            <label for="column" class="form-label">Select Column</label>
                            <select name="column" id="column" class="form-select">
                                <option value="" selected>Choose...</option>
                                <option value="rack_location">Rack Location</option>
                                <option value="rack_description">Rack Description</option>
                                <option value="object_code">Object Code</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="value" class="form-label">Search Value</label>
                            <input type="text" name="value" id="value" class="form-control" placeholder="Enter search value">
                        </div>

                        <!-- Buttons for Search and Show All -->
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="submit" name="search" class="btn btn-primary w-50">Search</button>
                            <button type="submit" name="show_all" class="btn btn-secondary w-50">Show All</button>
                        </div>

                        <!-- Second Row: Date Range Filter -->
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" name="filter_date" class="btn btn-secondary w-100 px-4 py-2">
                                Filter Dates
                            </button>
                        </div>
                    </form>

                    <!-- Table -->
                    <?php
                    include 'config/db.php';

                    // Default Query - No rows initially
                    $query = "SELECT * FROM racks WHERE 1=0";

                    // If Search Button is Clicked
                    if (isset($_GET['search']) && !empty($_GET['column']) && !empty($_GET['value'])) {
                        $column = $conn->real_escape_string($_GET['column']);
                        $value = $conn->real_escape_string($_GET['value']);
                        $query .= " AND $column LIKE '%$value%'";
                    }

                    // If Date Range Filter is Applied
                    if (isset($_GET['filter_date']) && !empty($_GET['start_date']) && !empty($_GET['end_date'])) {
                        $start_date = $conn->real_escape_string($_GET['start_date']);
                        $end_date = $conn->real_escape_string($_GET['end_date']);
                        $query .= " AND created_at BETWEEN '$start_date' AND '$end_date'";
                    }

                    // If Show All Button is Clicked
                    if (isset($_GET['show_all'])) {
                        $query = "SELECT * FROM racks";
                    }

                    // Execute Query
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        echo '<table id="racks" class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Rack Location</th>
                                <th scope="col">Rack Description</th>
                                <th scope="col">Object Code</th>
                                <th scope="col">Capacity</th>
                                <th scope="col">Current Quantity</th>
                                <th scope="col">Added on</th>';
                        if ($_SESSION['role'] == 'admin') {
                            echo '<th scope="col">Actions</th>';
                        }
                        echo '</tr></thead><tbody>';

                        while ($row = $result->fetch_assoc()) {
                            //count current quantity for current location of rack
                            // Get the current rack's location
                            $location = $row['rack_location']; // Adjust column name if necessary

                            // Query to count files in the current rack
                            $currentQuantityQuery = "SELECT COUNT(*) as quantity FROM box WHERE location = '$location'";
                            $currentQuantityResult = $conn->query($currentQuantityQuery);
                            $currentQuantity = 0; // Default value

                            if ($currentQuantityResult->num_rows > 0) {
                                $quantityRow = $currentQuantityResult->fetch_assoc();
                                $currentQuantity = $quantityRow['quantity'];
                            }

                            echo '<tr>';
                            echo '<td><a class="text-primary fw-bold" href="rackInfo.php?id=' . $row['id'] . '">' . $row['rack_location'] . '</a></td>';
                            echo '<td>' . htmlspecialchars($row['rack_description']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['object_code']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['capacity']) . '</td>';
                            echo '<td>' . $currentQuantity . '</td>';

                            // Format Date
                            $created_at = date("d-m-Y", strtotime($row["created_at"]));

                            echo '<td>' . $created_at . '</td>';

                            if ($_SESSION['role'] == 'admin') {
                                echo '<td>
                                <div style="display: flex; gap: 10px;">
                                    <a href="rackDelete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm" 
                                       onclick="return confirm(\'Are you sure you want to delete this record?\');">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>';
                            }
                            echo '</tr>';
                        }
                        echo '</tbody></table>';
                    } elseif (isset($_GET['search']) || isset($_GET['filter_date']) || isset($_GET['show_all'])) {
                        echo '<p class="text-center mt-3">No results found.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>


    <script>
        function filterCompany(comp_id) {
            window.location.href = "box.php?comp_id=" + comp_id;
        }
    </script>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- DataTables core library and export buttons -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

    <!-- Additional libraries for exporting (Excel, PDF) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Bootstrap and DataTables styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- SearchPanes and Select styling and functionality -->
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.3/css/searchPanes.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.1.0/css/select.bootstrap5.css">
    <script src="https://cdn.datatables.net/searchpanes/2.3.3/js/dataTables.searchPanes.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.3/js/searchPanes.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/2.1.0/js/dataTables.select.js"></script>

    <!--for icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">


    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        // event listener for search bar 
        document.getElementById("searchInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent default form submission
                document.getElementById("searchForm").submit(); // Manually submit the form
            }
        });
    </script>
    <!--for datatable-->
    <script>
        new DataTable('#racks', {
            // <!--make the table => datatable.net table and also change the alignment of the text in columns-->
            columnDefs: [{
                    className: "text-left",
                    targets: [0, 1, 2, 3, 4, 5],

                } // change alignment 

            ],
            "order": [
                [5, "desc"]
            ],

            //show 100 rows by default
            "pageLength": 100,

            //collapse by default
            "searchPanes": {
                "initCollapsed": true,
                columns: []
            }

        });
    </script>
</body>

</html>