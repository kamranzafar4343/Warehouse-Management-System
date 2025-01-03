<?php
// session_start(); // Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to login page
    header("Location: pages-login.php");
    exit();
}

include 'config/db.php';

$email = $_SESSION['email'];
//get user name and email from register table
$getAdminData = "SELECT * FROM register WHERE email = '$email'";
$resultData = mysqli_query($conn, $getAdminData);
if ($resultData->num_rows > 0) {
    $row2 = $resultData->fetch_assoc();
    $adminName = $row2['name'];
    $adminEmail = $row2['email'];
}

// Get order ID from query string
$order_no = $_GET['id'];

$sql = "SELECT * FROM `orders` WHERE `order_no` = '$order_no'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row3 = $result->fetch_assoc();
    $order_no = $row3['order_no'];
    $creator = $row3['creator'];

    $comp_id_fk = $row3['comp_id_fk'];

    //get company name from compani table
    $compName = "SELECT * FROM compani WHERE comp_id = $comp_id_fk";
    $compNameResult = $conn->query($compName);
    if ($compNameResult && $compNameResult->num_rows > 0) {
        $row4 = $compNameResult->fetch_assoc();

        $comp_name = $row4['comp_name'];
    }

    $branch_id_fk = $row3['branch_id_fk'];

    //get branch name from branch table
    $branchName = "SELECT * FROM branches WHERE branch_id = $branch_id_fk";
    $branchNameResult = $conn->query($branchName);
    if ($branchNameResult && $branchNameResult->num_rows > 0) {
        $row5 = $branchNameResult->fetch_assoc();

        $branch_name = $row5['branch_name'];
    }

    // $dept_id_fk = $row3['dept_id_fk'];
    // //get dept name from dept table
    // $deptName = "SELECT * FROM departments WHERE dept_id = $dept_id_fk";
    // $deptNameResult = $conn->query($deptName);
    // if ($deptNameResult && $deptNameResult->num_rows > 0) {
    //     $row6 = $deptNameResult->fetch_assoc();

    //     $branch_name = $row6['dept_name'];
    // }

    $priority = $row3['priority'];
    $flag = $row3['flag'];
    $date = $row3['date'];
    $foc = $row3['foc'];
    $phone = $row3['foc_phone'];
    $pickup_add = $row3['pickup_address'];
    $object = $row3['object_code'];
    $barcode = $row3['barcode'];
    // $alt = $row3['alt'];
    $requestor = $row3['requestor'];
    $role = $row3['role'];
    $req_date = $row3['req_date'];
    $description = $row3['description'];
    $create_date = $row3['order_creation_date'];
    $obj_type = $row3['obj_typ'];
    $quant = $row3['quant'];
    $supp_req = $row3['supp_requestor'];
    $cost_center = $row3['cost_cent'];
    $dateTime = $row3['dateTime'];
    $comment = $row3['comment'];
} else {
    echo "No order found";
}

// Set the default timezone to Pakistan Standard Time
date_default_timezone_set('Asia/Karachi');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>View Workorder</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom CSS to decrease font size of the table */

        .company-name {
            font-size: 1rem;
        }

        .datatable-wrapper.no-footer .datatable-container {
            border: none;
            margin-left: -315px !important;
            width: 700px !important;
        }

        .company-title {
            font-size: 1.1rem;
        }

        .burger {
            left: -10px;
            top: -20px;
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



        .card {
            margin-bottom: 30px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0 30px rgba(1, 41, 112, 0.1);
            background-color: white;
            font-size: 0.8rem;
            margin-top: 38px;
        }

        .container-card {
            font-size: 0.8rem;
            color: #666666;
            font-family: "Open Sans";
            width: 84%;
        }

        /* Custom CSS to place card and table side by side */
        .side-by-side-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            /* Align items to the start of the container */
            gap: 20px;
            /* Space between the card and table */
        }

        .company-name {
            color: #000;
            text-decoration: none;
            display: inline-block;
            transition: color 0.3s ease;
        }

        .img-fluid {
            margin-top: 20px;
            margin-left: 37px !important;
            margin-bottom: 15px;
        }

        .company-name:hover {
            color: #007bff;
            /* Change color on hover */
            animation: pulse 10s ease-in-out;
            /* Apply the pulse animation on hover */
        }

        .company-name:active {
            animation: clickEffect 0.s ease;
            /* Apply the click effect animation on click */
            color: #0056b3;
            /* Darken color on click */
        }

        .pagetitleinside {
            padding-left: 600px;
        }

        * {
            margin: 0;

            padding: 0;

            box-sizing: border-box;
        }

        .remix {
            margin-right: 5px;
        }

        /* styles for card */
        .custom {
            font-size: 0.8rem;
            border-radius: 7px;
            padding-top: 14px;
            padding-bottom: 14px;
            padding-right: 14px;
            padding-left: 18px;
            margin-left: 307px;
            /* table-layout: fixed; */
            /* width: 100%; */
            /* overflow: hidden; */
            /* text-overflow: ellipsis; */
            /* white-space: nowrap; */
        }

        tbody,
        td,
        tr {
            word-wrap: break-word;
            max-width: 200px;
        }

        .card-title-info {
            text-align: center;
        }

        .datatable-top {
            margin-left: 10px !important;
            width: 0px;
        }

        .customImage {
            border: 1px solid white;
            position: relative;
            top: 36%;
            left: 25%;

            /* Change cursor to indicate clickability */
        }

        .hiddenFileInput {
            display: none;
            /* Hide the file input */
        }

        /*Employee header*/
        .headerSetting {
            display: flex;
            gap: 250px;
        }

        .barcode {
            height: 30px;
            width: 230px;
            position: relative;
            left: -38px;
        }

        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 16px;
        }

        .invoice-container {
            margin: 20px auto;
            padding: 20px;
            max-width: 900px;
            background-color: #fff;
        }

        .header-section {
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: bold;
            text-align: center;

        }

        .signature-area {
            margin-top: 50px;
            text-align: center;
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
    <!-- sidebar start -->
    <?php
    include "sidebarcode.php";
    ?>
    <!-- sidebar end -->

    <main id="main" class="main">
        <!-- Print Button -->
        <button class="btn btn-primary mb-2 mt-3" style="margin-left: 840px;" onclick="$('#workorder').print();"><i class="ri-printer-line"></i> Print</button>
        <!-- <button class="btn btn-info mb-2 mt-3" style="margin-left: 840px;"><i class="ri-printer-line"></i> Download</button> -->
        <div class="headerbox">
        </div><!-- End Page Title -->
        <div class="pagetitleinside mt-1">
        </div>
        </div>

        <!-- Main content container -->
        <div class="">

            <!-- Invoice container -->
            <div class="invoice-container" id="workorder">
                <div class="header-section">
                    <div class="row mt-5">
                        <div class="col-4">
                            <p>
                                <?php
                                date_default_timezone_set("Asia/Karachi");
                                echo date("Y/m/d h:i:s A");
                                ?>
                            </p>
                        </div>
                        <div class="col-4 text-center">
                            <p style="text-transform: uppercase;"><?php echo $flag . " WORKORDER"; ?></p>

                            <p class="mb-4">
                                <?php
                                if ($priority == "Regular") {

                                    echo "REGULAR - Next Working Day";
                                } elseif($priority == "Urgent") {
                                    echo "Urgent - Rush Same Day";
                                }
                                else{
                                    echo '';
                                }
                                ?>
                            </p>

                        </div>
                        <div class="col-4 text-right">
                            <?php echo  '<img class="barcode" alt="' . $order_no . '" src="barcode.php?text=' . $order_no . '&codetype=code128&orientation=horizontal&size=20&print=false"/>'; ?>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <p>
                                    <?php echo $comp_name ?><br>
                                    <?php echo $branch_name ?><br>
                                    <?php echo $pickup_add ?><br>
                                    CONTACT: <?php echo $role ?><br>
                                    PHONE: <?php echo $phone ?><br>
                                </p>
                            </div>

                            <!-- convert create date to local format -->
                            <?php ?>
                            <div class="col-6">

                                <!-- convert date into pk timezone -->
                                <?php

                                if (!empty($create_date)) {
                                    // Create a DateTime object
                                    $date = new DateTime($create_date, new DateTimeZone('UTC')); // Assuming the original date is in UTC

                                    // Set the timezone to Pakistan Standard Time (PKT)
                                    $date->setTimezone(new DateTimeZone('Asia/Karachi'));

                                    // Format the date as needed
                                    $formattedDate = $date->format("Y/m/d h:i:s A");
                                ?>
                                    <p><?php echo "No. " . $order_no . "  " . $formattedDate;
                                    } ?><br>

                                    Service Date: <?php echo date(" Y/m/d h:i:s A") ?><br>
                                    </p>

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-0 text-center">
                            <?php $showOrders = "Select * FROM orders WHERE order_no = '$order_no'";
                            $resultShowOrders = $conn->query($showOrders);

                            // Check if there are any results
                            if ($resultShowOrders->num_rows > 0) {
                                // Loop through results
                                while ($row = $resultShowOrders->fetch_assoc()) {
                            ?>
                                    <?php
                                    $barcodes = explode(',', $row['barcode']); // Split comma-separated values into an array
                                    // echo '<ul style="list-style: none; margin-left: -30px;">'; // Start unordered list

                                    $containerCount = 0;
                                    $filefolderCount = 0;

                                    foreach ($barcodes as $barcode) {

                                        //run counter variables
                                        if (strlen(trim($barcode)) == 7) { // Check for 7-character barcodes
                                            $containerCount++;
                                        } elseif (strlen(trim($barcode)) == 8) { // Check for 8-character barcodes
                                            $filefolderCount++;
                                        }
                                    }
                                    ?>
                        </div>
                        <div class="col-9 text-left">
                            <?php
                                    // Dynamically generate barcodes from the input
                                    $barcodes = explode(',', $row['barcode']);
                                    $barcodeList = implode(',', array_map('intval', $barcodes));

                                    // Query to fetch grouped alternate codes and locations
                                    $getAltAndLocation = "
        SELECT barcode, 
               GROUP_CONCAT(DISTINCT alt_code) AS alt_codes,
               GROUP_CONCAT(DISTINCT location) AS locations
        FROM box
        WHERE barcode IN ($barcodeList)
        GROUP BY barcode";

                                    $resultAltAndLocation = $conn->query($getAltAndLocation);

                                    // Start the table
                                    echo '<table class="table table-borderless" >';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>Location</th>';
                                    echo '<th>Containers</th>';
                                    echo '<th>Alternate Code</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';

                                    if ($resultAltAndLocation && $resultAltAndLocation->num_rows > 0) {
                                        while ($rowAltLoc = $resultAltAndLocation->fetch_assoc()) {
                                            $barcode = htmlspecialchars($rowAltLoc['barcode']);
                                            $altCodes = isset($rowAltLoc['alt_codes']) ? explode(',', $rowAltLoc['alt_codes']) : []; // Handle NULL values
                                            $locations = isset($rowAltLoc['locations']) ? explode(',', $rowAltLoc['locations']) : []; // Handle NULL values

                                            // Ensure there is a row for each combination of location and alternate code
                                            $maxRows = max(count($locations), count($altCodes));

                                            for ($i = 0; $i < $maxRows; $i++) {
                                                echo '<tr>';
                                                echo '<td>' . htmlspecialchars($locations[$i] ?? 'N/A') . '</td>'; // Use 'N/A' if location is missing
                                                echo '<td>' . ($i === 0 ? $barcode : '') . '</td>'; // Only show barcode once
                                                echo '<td>' . htmlspecialchars($altCodes[$i] ?? 'N/A') . '</td>'; // Use 'N/A' if alt code is missing
                                                echo '</tr>';
                                            }
                                        }
                                    } else {
                                        echo '<tr>';
                                        echo '<td colspan="3">No barcodes, alternate codes, or locations found.</td>';
                                        echo '</tr>';
                                    }

                                    // Close the table
                                    echo '</tbody>';
                                    echo '</table>';
                            ?>
                        </div>



                        <div class="col-3 text-left">
                            <p><b>Requestor: </b><br>
                                <?php
                                    $getFOC = "SELECT * FROM employee WHERE emp_id = '$foc'";
                                    $resultFOC = $conn->query($getFOC);

                                    if ($resultFOC->num_rows > 0) {
                                        $rowFOC = $resultFOC->fetch_assoc();
                                        echo $rowFOC['name'] . " / " . $branch_name;
                                    }
                                ?>
                            </p>
                        </div>

                        <!-- show description -->
                        <div class="row">
                            <div class="col-md-6">
                                <?php 
                                    if(!empty($description)){
                                        ?>
                                        <p><b>Description</b>: </b><br>
                                        <?php
                                        echo $description;
                                    }
                                ?>
                            </div>
  
                            <div class="col-md-6">

                            </div>
                        </div>

                        <div class="section-title mb-2 mt-3">WORKORDER SUMMARY</div>

                        <p>Total <?php echo $flag; ?> Items
                            <br>
                        </p>

                        <div class="row">

                            <div class="col-4">

                                <p>Containers:
                                    <?php
                                    echo $containerCount;
                                    ?><br>
                                </p>
                            </div>
                            <div class="col-4 text-center">
                                <p>Filefolders:
                                    <?php
                                    echo $filefolderCount;
                                    ?><br>
                                </p>

                            </div>
                        </div>
                <?php



                                }
                            }
                ?>
                <br><br><br><br>
                <br><br><br><br>
                <br><br><br><br>
                <br><br><br><br>

                <br><br><br><br>
                <br><br><br><br>
                <br><br><br><br><br><br><br>




                <div class="row mt-5">
                    <div class="col-6 text-center">

                        ------------------------------------------------------------------------------
                        <br> Data Technologies

                    </div>
                    <br>
                    <div class="col-6 text-center">
                        ------------------------------------------------------------------------------
                        <br> <?php echo $comp_name ?> -
                        <?php echo $branch_name ?>

                    </div>
                </div>

                    </div>
                </div>


            </div>
        </div>
        </div>

        </div>
        </div>
        <!-- End d-flex container -->
    </main><!-- End #main -->

    <!-- added jquery code for printing specific part of page -->
    <script>
        $.fn.extend({
            print: function() {
                var frameName = 'printIframe';
                var doc = window.frames[frameName];
                if (!doc) {
                    $('<iframe>')
                        .hide()
                        .attr('name', frameName)
                        .appendTo(document.body);
                    doc = window.frames[frameName];
                }

                var content = this.html();
                var styles = $('head').html(); // Get the content of the <head>, including stylesheets and inline styles

                // Write the content and styles into the iframe's document
                doc.document.open();
                doc.document.write('<!DOCTYPE html><html><head>' + styles + '</head><body>' + content + '</body></html>');
                doc.document.close();
                doc.window.print();
                return this;
            }
        });
    </script>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>