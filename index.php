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

//get email from session 
$email = $_SESSION['email'];
//get user name and email from register table
$getAdminData = "SELECT * FROM register WHERE email = '$email'";
$resultData = mysqli_query($conn, $getAdminData);
if ($resultData->num_rows > 0) {
  $row2 = $resultData->fetch_assoc();
  $adminName = $row2['name'];
  $adminEmail = $row2['email'];
}

// Check if the user is labour
if ($_SESSION['role'] == 'Labour' && $_SESSION['role'] == 'Labour') {
  //redirect to  page
  header("Location: labour_index.php");
  exit();
}

//get total no of companies for compani card
$query = "SELECT COUNT(*) AS count FROM compani";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$companyCount = $row['count'];

//get no of branches for branch card
$queryBranches = "SELECT COUNT(*) AS branch_count FROM branches";
$resultBranches = mysqli_query($conn, $queryBranches);
$rowBranches = mysqli_fetch_assoc($resultBranches);
$branchCount = $rowBranches['branch_count'];

//get no of items for item card
$queryDept = "SELECT COUNT(*) AS dept_count FROM departments";
$resultDept = mysqli_query($conn, $queryDept);
$rowDept = mysqli_fetch_assoc($resultDept);
$DeptCount = $rowDept['dept_count'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
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

  <!-- Datatable css for export buttons -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">

  <link rel="stylesheet" href="fonts/icomoon/style.css">


  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">
  <style>
   .h6, h6 {
    font-size: 2rem;
    margin-left: 12px;
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

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item profileimage dropdown pe-3 mr-4">

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

  <div class="pagetitle mt-4">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">

                <!-- Pending Workorders Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-primary rounded-circle p-3">
                                <img src="assets/img/pending.png" alt="Pending" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Pending Workorders</h5>
                                <h6>9</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Workorders Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-success rounded-circle p-3">
                                <img src="assets/img/complete.png" alt="Complete" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Completed Workorders</h5>
                                <h6>12</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Workorders Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-info rounded-circle p-3">
                                <img src="assets/img/icons8-order-27.png" alt="Order" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Total Workorders</h5>
                                <h6>32</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Cancelled Workorders Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-danger rounded-circle p-3">
                                <img src="assets/img/icons8-cancel-26.png" alt="Cancel" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Cancelled Workorders</h5>
                                <h6>2</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Regular Workorders Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-warning rounded-circle p-3">
                                <img src="assets/img/icons8-regular-document-27 (1).png" alt="Regular" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Regular Workorders</h5>
                                <h6>20</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Urgent Workorders Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-danger rounded-circle p-3">
                                <img src="assets/img/Time-Clock-Fire--Streamline-Ultimate.png" alt="Urgent" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Urgent Workorders</h5>
                                <h6>10</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php
            // If the user is Labour, show assigned and completed tasks
            if ($_SESSION['role'] == 'Labour') {
            ?>
                <!-- Assigned Tasks Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-primary rounded-circle p-3">
                                <img src="assets/img/Task-List-Assign--Streamline-Freehand (2).png" alt="Assigned" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Assigned Tasks</h5>
                                <h6>20</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Tasks Card -->
                <div class="col-xxl-4 col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="card-icon bg-success rounded-circle p-3">
                                <img src="assets/img/complete.png" alt="Complete" width="30">
                            </div>
                            <div class="ps-3">
                                <h5 class="card-title">Completed Tasks</h5>
                                <h6>10</h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</section>


</main><!-- End #main -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>