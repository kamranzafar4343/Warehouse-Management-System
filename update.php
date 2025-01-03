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

// Get session email 
$email = $_SESSION['email'];

// Get user name, email, and role from the register table
$getAdminData = "SELECT * FROM register WHERE email = '$email'";
$resultData = mysqli_query($conn, $getAdminData);
if ($resultData->num_rows > 0) {
  $row2 = $resultData->fetch_assoc();
  $adminName = $row2['name'];
  $adminEmail = $row2['email'];
  $userRole = $row2['role']; // Assuming you have a 'role' column in the 'register' table
}

// Check if the user is an admin, otherwise redirect
if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  // If the user is not an Admin, redirect to index page
  header("Location: index.php");
  exit();
}
if (isset($_GET['id'])) {
  $comp_id = intval($_GET['id']);  // Get the company ID from URL

  // SQL query to fetch company data
  $sql = "SELECT * FROM `compani` WHERE `comp_id` = '$comp_id'";
  $result = $conn->query($sql);

  // Check if the company exists
  if ($result && $result->num_rows > 0) {

    // Fetch company data into variables
    $row = $result->fetch_assoc();
    $comp_name = $row['comp_name'];
    $description = $row['acc_desc'];
    $registration_date = $row['registration'];
    $expiry_date = $row['expiry'];
    $contact_person = $row['foc'];
    $contact_phone = $row['foc_phone'];
    $address = $row['add_1'];
    $comp_email = $row['email'];
    $e_auth = $row['auth'];
    $e_role = $row['role'];
  } else {
    // If no company found, display an error message
    echo "Company not found!";
    exit;
  }
}

// Check if the form is submitted (update the record)
if (isset($_POST['update'])) {
  // Sanitize and retrieve form data

  $comp_name = mysqli_real_escape_string($conn, $_POST['comp_name']);
  $get_description = mysqli_real_escape_string($conn, $_POST['desc']);
  $registration_date = mysqli_real_escape_string($conn, $_POST['registration']);
  $expiry_date = mysqli_real_escape_string($conn, $_POST['expiry']);
  $contact_person = mysqli_real_escape_string($conn, $_POST['foc']);
  $contact_phone = mysqli_real_escape_string($conn, $_POST['foc_phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $input_auth = mysqli_real_escape_string($conn, $_POST['authority']);
  $input_role = mysqli_real_escape_string($conn, $_POST['role']);

  // SQL query to update the company record
  $sql = "UPDATE `compani` SET 
            
            `comp_name` = '$comp_name',
`acc_desc` = '$get_description',
            `registration` = '$registration_date',
            `expiry` = '$expiry_date',
            `foc` = '$contact_person',
            `foc_phone` = '$contact_phone',
            `add_1` = '$address',
            `auth` = '$input_auth',
            `role` = '$input_role'
          WHERE `comp_id` = '$comp_id'";

  // Execute the query and check for success or error
  if (mysqli_query($conn, $sql)) {
    // Redirect to the Companies.php page after successful update
    header("Location: Companies.php?id=" . $comp_id);
    exit;
  } else {
    // Display an error message if the update fails
    echo "Error updating record: " . mysqli_error($conn);
  }

  // Close the database connection
  $conn->close();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Update Company</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
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
  <link href="assets/img/favicon.png" rel="icon">
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

  <style>
    .image-circle {
      margin-left: 335px;
      margin-top: 36px;
      margin-bottom: 18px;
      border: 2px solid white;
      width: 85px;
      padding: 5px;
    }

    .image-circle:hover {
      opacity: 0.60;
    }

    .image-circle img {
      width: 120px;
    }

    .img {
      border-radius: 30%;
    }

    .custom {
      font-size: 0.9rem;
      /* Adjust as needed */
      font-family: monospace;
    }

    .company-name {
      font-size: 1rem;
    }

    .company-title {
      font-size: 1.1rem;
    }

    .burger {
      left: -10px;
      top: -20px;
    }

    .custom-card2 {
      width: 100%;
      margin-left: 290px;
      box-shadow: none;
      border: none;

    }

    /*styles for form*/
    .card-body {
      padding: 0 20px 20px 20px;
      font-size: 0.8rem;
    }

    .form-control[type=file]:not(:disabled):not([readonly]) {
      cursor: pointer;
      font-size: 0.8rem;
    }

    input[type=date].form-control {
      appearance: none;
      font-size: 0.8rem;
    }

    @media (min-width: 1200px) {

      .h2,
      h2 {
        font-size: 1.5rem;
      }
    }

    .headerimg h2 {
      font-family: "Nunito", sans-serif;
      font-size: 1.5rem;
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

    .card-title {
      margin-bottom: 40px;
    }

    .company-name {
      color: #000;
      text-decoration: none;
      display: inline-block;
      transition: color 0.3s ease;
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

    * {
      margin: 0;

      padding: 0;

      box-sizing: border-box;
    }

    .headerimg {
      margin-left: 290px;
    }

    .custom-card {
      width: 60%;
      margin-top: 50px;
      box-shadow: none;
      border: none;
    }
  </style>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <title>Update</title>

</head>

<body>

  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="assets/img/dtl.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
    <link href="assets/img/favicon.png" rel="icon">
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

    <style>
      /* Custom CSS to decrease font size of the table */
      .custom {
        font-size: 0.9rem;
        /* Adjust as needed */
        font-family: monospace;
      }

      .company-name {
        font-size: 1rem;
      }

      .company-title {
        font-size: 1.1rem;
      }

      .burger {
        left: -10px;
        top: -20px;
      }

      .headerimg {
        margin-top: 104px;
        margin-left: 260px;
      }

      .custom-header {
        background-color: white;
        /* Light gray background */
        color: #343a40;
        /* Dark text color */
        font-weight: bold;
        /* Bold text */
        text-align: center;
        /* Center align text */
        padding: 14px;
        /* Bottom border */
        margin-left: 19px;
      }


      /*styles for form*/
      .card-body {
        padding: 0 20px 20px 20px;
        font-size: 0.8rem;
      }

      .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
        font-size: 0.8rem;

      }

      input[type=date].form-control {
        appearance: none;
        font-size: 0.8rem;
      }

      @media (min-width: 1200px) {

        .h2,
        h2 {
          font-size: 1.5rem;
        }
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

      * {
        margin: 0;

        padding: 0;

        box-sizing: border-box;
      }

      .custom-card {
        width: 100%;
        margin-top: 64px;
        margin-left: 290px;
        box-shadow: none;

        border: none;
      }
    </style>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <title>Register Company</title>


  </head>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <img class="navbar-image" src="assets/img/dtl.png" alt="">
      <a href="index.php" class="logo d-flex align-items-center">

        <span class="d-none d-lg-block"></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- 
<div class="search-bar">
  <form class="search-form d-flex align-items-center" method="POST" action="#">
    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
  </form>
</div>
End Search Bar -->

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

  <?php
  include "config/db.php";

  $role = $_SESSION['role'];
  ?>

  <!-- sidebar start -->
  <?php
  include "sidebarcode.php";
  ?>
  <!-- sidebar end -->

  <!-- Start Header form -->
  <div class="headerimg text-center">
    <img src="image/update.png.png" alt="network-logo" width="50" height="50" />
    <h2>Update Company Information</h2>
  </div>
  <!-- End Header form -->

  <div class="container d-flex justify-content-center">
    <div class="card custom-card shadow-lg mt-3">
      <!-- <h5 class="card-title ml-4">Create Company </h5> -->
      <div class="card-body">
        <br>
        <!-- Multi Columns Form -->
        <form class="row g-3 needs-validation" action="" method="POST">

          <div class="col-md-6">
            <label for="comp_name" class="form-label">Comp_name</label>
            <input class="form-control" id="comp_name" name="comp_name" value="<?php echo $comp_name; ?>" readonly>
          </div>
          <div class="col-md-6">
            <label for="account_description" class="form-label">Description</label>
            <textarea class="form-control" name="desc" required><?php echo $description; ?></textarea>
          </div>
          <div class="col-md-6">
            <label for="registration" class="form-label">Setup Date</label>
            <input type="date" class="form-control" id="registration" name="registration" value="<?php echo $registration_date; ?>" readonly>
          </div>

          <div class="col-md-6 mb-3">
            <label for="expiry" class="form-label">Contract Expiry Date</label>
            <input type="date" class="form-control" id="expiry" name="expiry" value="<?php echo $expiry_date; ?>">
          </div>

          <div class="col-md-6">
            <label for="foc" class="form-label">Contact Person</label>
            <input type="text" class="form-control" id="foc" name="foc" value="<?php echo $contact_person; ?>" required pattern="[A-Za-z\s\.]+" minlength="3" maxlength="38" title="only letters allowed; at least 3">
          </div>
          <div class="col-md-6">
            <label for="phone" class="form-label">Access/Authority</label>
            <select name="authority" id="" class="form-select">
              <option value="">Select level of access</option>
              <option value="can get information about branch boxes" <?php echo $e_auth == 'can get information about branch boxes' ? 'selected' : ''; ?>>can get information about branch boxes</option>
              <option value="only retrieve department boxes" <?php echo $e_auth == 'only retrieve department boxes' ? 'selected' : ''; ?>>only retrieve department boxes</option>
              <option value="all departments of their branch" <?php echo $e_auth == 'all departments of their branch' ? 'selected' : ''; ?>>all departments of their branch</option>
              <option value="all departments and all branches of company" <?php echo $e_auth == 'all departments and all branches of company' ? 'selected' : ''; ?>>all departments and all branches of company</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="" class="form-label">Designation</label>
            <select name="role" id="" class="form-select">

              <option value="">Select Role of the Employee</option>
              <option value="<?php echo $e_role == 'Unit Head Re-pricing, Archiving & NOC Issuance|CDBOD' ? 'selected' : ''; ?>					
">Unit Head Re-pricing, Archiving & NOC Issuance|CDBOD
              </option>
              <option value="<?php echo $e_role == 'Manager Archiving & NOC Issuance' ? 'selected' : ''; ?>				
">Manager Archiving & NOC Issuance
              </option>
              <option value="<?php echo $e_role == 'Sr. Officer Archiving | ASSETS OPERATIONS-CDBOD' ? 'selected' : ''; ?>	 					
">Sr. Officer Archiving | ASSETS OPERATIONS-CDBOD
              </option>
              <option value="<?php echo $e_role == 'Officer Archiving | ASSETS OPERATIONS-CDBOD' ? 'selected' : ''; ?>
">Officer Archiving | ASSETS OPERATIONS-CDBOD
              </option>
              <option value="<?php echo $e_role == 'Unit Head | Collection Operations' ? 'selected' : ''; ?>					 					
">Unit Head | Collection Operations
              </option>
              <option value="<?php echo $e_role == 'Senior Officer Remittance Services | C&GTBO Division' ? 'selected' : ''; ?>
">Senior Officer Remittance Services | C&GTBO Division
              </option>
              <option value="<?php echo $e_role == 'Compliance Officer | C&GTBO Division' ? 'selected' : ''; ?>
">Compliance Officer | C&GTBO Division
              </option>
              <option value="<?php echo $e_role == 'Unit Head-System Development & Quality Assurance |GTCMOD' ? 'selected' : ''; ?>					
">Unit Head-System Development & Quality Assurance |GTCMOD
              </option>
              <option value="<?php echo $e_role == 'Senior Manager Infrastructure & Services | BFC Office' ? 'selected' : ''; ?>
">Senior Manager Infrastructure & Services | BFC Office
              </option>
              <option value="<?php echo $e_role == 'Team Lead – North' ? 'selected' : ''; ?>">Team Lead – North
              </option>
              <option value="<?php echo $e_role == 'Record Management Officer' ? 'selected' : ''; ?>">Record Management Officer
              </option>
              <option value="<?php echo $e_role == 'Head of General Services' ? 'selected' : ''; ?>">Head of General Services
              </option>
              <option value="<?php echo $e_role == 'General Manager Accounts' ? 'selected' : ''; ?>">General Manager Accounts
              </option>

            </select>
          </div>


          <div class="col-md-6">
            <label for="foc_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="foc_phone" name="foc_phone" value="<?php echo $contact_phone; ?>" required>
          </div>

          <div class="col-md-6">
            <label for="comp_email" class="form-label">Email</label>
            <input class="form-control" id="comp_email" name="comp_email" value="<?php echo $comp_email; ?>">
          </div>


          <div class="col-md-6">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-outline-primary mt-3" name="update" value="update">Update</button>
          </div>
        </form>
      </div>
    </div>
    </section>
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
    <script>
      const dataTable = new simpleDatatables.DataTable("#myTable2", {
        searchable: false,
        fixedHeight: true,
      })
    </script>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js">
    </script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z1gk35k1RA6QQg+SjaK6MjpS3TdeL1h1jDdED5+ZIIbsSdyX/twQvKZq5uY15B" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9BfDxO4v5a9J9TZz1ck8vTAvO8ue+zjqBd5l3eUe8n5EM14ZlXyI4nN" crossorigin="anonymous"></script>
    <script>
      <?php if (isset($_SESSION['data_inserted']) && $_SESSION['data_inserted']): ?>
        alert('Company Updated successfully! Click OK to see the Companies List');
        window.location.href = 'Companies.php';
        <?php unset($_SESSION['data_inserted']); // Clear the session variable 
        ?>
      <?php elseif (isset($_SESSION['data_inserted']) && !$_SESSION['data_inserted']): ?>
        alert('Failed to enter new data.');
        <?php unset($_SESSION['data_inserted']); ?>
      <?php endif; ?>



      //click on the picture to update with ajax
      $(document).on('click', 'img', function() {
        $(this).next('input[type="file"]').click();
      });

      function uploadImage(comp_id) {
        var fileInput = document.getElementById('file-' + comp_id);
        var file = fileInput.files[0];
        var formData = new FormData();
        formData.append('image', file);
        formData.append('comp_id', comp_id);

        $.ajax({
          url: 'update_image.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            // Update the image source with the new image path
            $('#image-' + comp_id).attr('src', response);
          },
          error: function() {
            alert('Image upload failed. Please try again.');
          }
        });
      }
    </script>

</body>

</html>