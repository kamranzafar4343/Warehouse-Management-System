<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: pages-login.php");
    exit();
}

include "config/db.php"; // Include database connection

$email = $_SESSION['email'];

// Get user data from the register table
$getAdminData = "SELECT * FROM register WHERE email = '$email'";
$resultData = mysqli_query($conn, $getAdminData);
if ($resultData->num_rows > 0) {
    $row2 = $resultData->fetch_assoc();
    $adminName = $row2['name'];
    $adminEmail = $row2['email'];
}
if (isset($_POST['submit'])) {
    // Collect form data
    $comp = mysqli_real_escape_string($conn, $_POST['company']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $barcode_select = $conn->real_escape_string($_POST['barcode_select']);
    $description = $conn->real_escape_string($_POST['description']);
    $rack_select = $conn->real_escape_string($_POST['rack_select']);

    // Check if the barcode is already used (no duplicates allowed)
    // $duplicate_check_sql = "SELECT * FROM store WHERE barcode_select = '$barcode_select'";
    // if ($duplicate_check_result-> num_rows > 0) {
        // Barcode already exists, show error
    //     echo "<script>alert('Duplicate barcode detected. Please use a unique barcode.'); window.location.href = 'storedata.php';</script>";
    // } else {
        // Check if the selected rack already contains 9 boxes (max limit for each rack)
        // $rack_limit_check_sql = "SELECT COUNT(*) as total_boxes FROM store WHERE rack_select = '$rack_select'";
        // $rack_limit_check_result = $conn->query($rack_limit_check_sql);
        // $rack_data = $rack_limit_check_result->fetch_assoc();

        // if ($rack_data['total_boxes'] >= 9) {
            // Rack already contains 9 boxes, show error
        //     echo "<script>alert('This rack already contains 9 boxes. Please select another rack.'); window.location.href = 'storedata.php';</script>";
        // } else {
            // SQL query to insert data into the database
            $sql = "INSERT INTO store (comp_id_fk, branch_id_fk, box, description, rack_select, status)
                    VALUES ('$comp', '$branch', '$barcode_select','$description', '$rack_select', 'In')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>window.location.href = 'store.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        // }
    // }

    // Close the connection
    $conn->close();
}

?>




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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
            margin-top: 100px;
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

    <title> Add the Rack</title>


</head>

<body> <!-- ======= Header ======= -->
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

    <!-- ======= Sidebar ======= -->
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <!-- Dashboard Link (Visible to all users) -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php">
                    <i class="ri-home-8-line"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <?php if ($_SESSION['role'] == 'admin') { ?>
                <!-- Admin-only Links -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="Companies.php">
                        <i class="ri-building-4-line"></i><span>Accounts</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Companies Nav -->


                <li class="nav-item">
                    <a class="nav-link collapsed" href="box.php">
                        <i class="ri-archive-stack-fill"></i><span>Containers</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Boxes Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="order.php">
                        <i class="ri-list-ordered"></i><span>Work Orders</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Work Orders Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="racks.php">
                        <i class="bi bi-box"></i><span>Racks</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Racks Nav -->

                <li class="nav-item">
                    <a class="nav-link active" href="store.php">
                        <i class="bi bi-shop"></i><span>Store</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Store Nav -->

            <?php } else { ?>
                <!-- User-only Links -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="box.php">
                        <i class="ri-archive-stack-fill"></i><span>Boxes</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Boxes Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="showItems.php">
                        <i class="ri-shopping-cart-line"></i><span>Items</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Items Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="order.php">
                        <i class="ri-list-ordered"></i><span>Work Orders</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Work Orders Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="racks.php">
                        <i class="bi bi-box"></i><span>Racks</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Racks Nav -->

                <li class="nav-item">
                    <a class="nav-link active" href="store.php">
                        <i class="bi bi-shop"></i><span>Store</span><i class="bi bi-chevron ms-auto"></i>
                    </a>
                </li><!-- End Store Nav -->
            <?php } ?>


            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-login.php">
                    <i class="bi bi-box-arrow-right"></i><span>Login</span>
                </a>
            </li><!-- End Login Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                    <i class="bi bi-box-arrow-left"></i><span>Logout</span>
                </a>
            </li><!-- End Logout Nav -->

        </ul>
    </aside>
    <!--------------- End sidebar ------------------>


    <!-- ---------------------------------------------------End Sidebar--------------------------------------------------->


    <!--form--------------------------------------form--------------------------------------->

    <!-- Start Header Form -->
    <div class="headerimg text-center">
        <i class="bi bi-shop" style="font-size: 50px; color: #333;"></i>
        <h2>Add Box & Rack</h2>
    </div>
    <!-- End Header Form -->

    <!-- Start Form Container -->
    <div class="container d-flex justify-content-center">
        <div class="card custom-card shadow-lg mt-3">
            <div class="card-body">
                <form class="row g-3 needs-validation" action="" method="POST" id="rackForm">

                    <!-- Select Company -->
                    <div class="col-md-4">
                        <label for="company">Company:</label>
                        <select id="company" class="form-select" name="company" required>
                            <option value="">Select Company</option>
                            <?php
                            // Fetch the account levels from the database
                            $result = $conn->query("SELECT comp_id, comp_name FROM compani");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['comp_id']}'>{$row['comp_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="col-md-4">
                        <label for="branch">Branch:</label>
                        <select id="branch" class="form-select" name="branch" required>
                            <option value="">Select branch</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="dept">Department:</label>
                        <select id="dept" class="form-select" name="dept">
                            <option value="">Select Department</option>
                        </select>
                    </div>

                    <!-- Select barcode -->
                    <div class="col-md-6">
                        <label for="barcodes">Select Container/Filefolder:</label>
                        <select id="barcode" class="form-select" id="barcode_select" name="barcode_select" required>
                            <option value="">Select barcode</option>
                            <!-- dynamically populate with ajax -->
                        </select>
                    </div>

                    <!-- Select Rack -->
                    <div class="col-md-6">
                        <label for="rack_select" class="form-label">Select Rack</label>
                        <select class="form-select" id="rack_select" name="rack_select" required>
                            <option value="" disabled selected>Select a rack Location</option>
                            <?php
                            // Fetch the account levels from the database
                            $result = $conn->query("SELECT id, rack_location FROM racks");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['rack_location']}'>{$row['rack_location']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                     <!--  Description -->
                     <div class="col-md-8">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                    </div>

                    <script>
                        // Get today's date
                        const today = new Date();
                        const tenYearsFromToday = new Date();

                        // Add 10 years to today's date
                        tenYearsFromToday.setFullYear(today.getFullYear() + 10);

                        // Function to format date as YYYY-MM-DD for date input
                        const formatDate = (date) => {
                            const year = date.getFullYear();
                            const month = ('0' + (date.getMonth() + 1)).slice(-2); // Adding leading zero
                            const day = ('0' + date.getDate()).slice(-2); // Adding leading zero
                            return `${year}-${month}-${day}`;
                        };

                        // Set the current date
                        document.getElementById('current-date').value = formatDate(today);

                        // Set the date 10 years from today
                        document.getElementById('future-date').value = formatDate(tenYearsFromToday);
                    </script>

                    <!-- Form Buttons -->
                    <div class="text-center mt-4 mb-2">
                        <button type="reset" class="btn btn-outline-info mr-1" onclick="window.location.href = 'store.php';">Cancel</button>
                        <button type="submit" class="btn btn-outline-primary mr-1" name="submit" value="submit">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Form Container -->

    <!-- Include Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal for duplicate entry error -->
    <div class="modal fade" id="duplicateErrorModal" tabindex="-1" aria-labelledby="duplicateErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="duplicateErrorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Duplicate entry detected. Please ensure all fields are unique.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // When company is changed, fetch the branches
        $('#company').change(function() {
            var company_id = $(this).val();

            // AJAX request to get branches for the selected company
            $.ajax({
                url: 'get_branches.php',
                type: 'POST',
                data: {
                    company_id: company_id
                },
                success: function(response) {
                    try {
                        var branches = JSON.parse(response); //return the json response as an array
                        // Clear existing branches
                        $('#branch').empty();
                        $('#branch').append('<option value="">Select branches</option>');
                        // Add the new options from the response
                        $.each(branches, function(index, branch) {
                            $('#branch').append('<option value="' + branch.branch_id + '">' + branch.branch_name + '</option>');
                        });
                        // Refresh or reinitialize dselect
                        dselect(document.querySelector('#branch'), config);
                    } catch (e) {
                        console.error("Invalid JSON response", response);
                    }
                }
            });
        });


        // When branch is changed, fetch the barcodes
        $('#branch').change(function() {
                var branch_id = $(this).val();
                // console.log(branch_id);

                // AJAX request to get barcodes for the selected branch
                $.ajax({
                    url: 'getBarcodes.php',
                    type: 'POST',
                    data: {
                        branch_id: branch_id
                    },
                    success: function(response) {
                        try {
                            var boxes = JSON.parse(response); //return the json response as an array
                            // Clear existing dept's
                            $('#barcode').empty();
                            $('#barcode').append('<option value="">Select barcode</option>');

                            // Add the new options from the response
                            $.each(boxes, function(index, box) {
                                $('#barcode').append('<option value="' + box.barcode + '">' + box.barcode + '</option>');

                            });
                            // Refresh or reinitialize dselect
                            dselect(document.querySelector('#barcode'), config);
                        } catch (e) {
                            console.error("Invalid JSON response", response);
                        }
                    }
                });
            });
    </script>

    <!-- JavaScript to prevent form submission when duplicate detected
    <script>
        document.getElementById('rackForm').addEventListener('submit', function(event) {
            if (document.querySelector('#duplicateErrorModal').classList.contains('show')) {
                event.preventDefault();
            }
        });
    </script> -->


</body>

</html>