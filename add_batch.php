<?php

include("dbinfo.php");

$put_class = false;
$create_table = false;
$alredy_table = false;
$error_message = "";       

$sel_t_name = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'student_management'";
$alert_fatch_tbl = mysqli_query($con, $sel_t_name);
$alert_row = mysqli_fetch_array($alert_fatch_tbl);

if (isset($_POST['add'])) {
    $t_name = $_POST['class-name'];
    if ($t_name != "") {
        if ($t_name != $alert_row['table_name']) {
            $qur = "CREATE TABLE $t_name (
                id INT PRIMARY KEY,
                name VARCHAR(50),
                course VARCHAR(50),
                email VARCHAR(50) UNIQUE,
                fees INT,
                live_date DATE
            )";

            // Try to execute the query
            try {
                $res = mysqli_query($con, $qur);
                if ($res) {
                    $create_table = true;
                    header('location:add_batch.php');
                    exit; // Ensure to exit after redirecting
                }
            } catch (mysqli_sql_exception $e) {
                $alredy_table = true;
                $error_message = "The class '$t_name' already exists.";
            }
        } else {
            $alredy_table = true;
            $error_message = "The class '$t_name' already created successfully.";
        }
    } else {
        $put_class = true;
    }
}
?>
<?php
session_start();

// Check if the session variable 'name' is set and not empty
if (!isset($_SESSION['name']) || $_SESSION['name'] === '') {
    header('Location: pages-login.php');
    exit(); // Make sure to call exit after a redirect
}

// Check if the user is either 'admin' or 'Fee System'
if ($_SESSION['name'] !== 'admin') {
    header('Location: pages-login.php');
    exit(); // Make sure to call exit after a redirect
}

// Rest of your code goes here

?>
  
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student-Management</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
  <header id="header" class="header fixed-top d-flex align-items-center bg-dark text-light">

    <div style="width: 400px;" class="d-flex align-items-center justify-content-between">
      <a style="width: 300px;" href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block text-light">Student Management</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn text-light"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
     
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search text-light"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/<?php echo $_SESSION['pic'] ; ?>" width="50" height="" alt="" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2 text-light"><?php echo  $_SESSION['name']?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
             
              <span><?php echo $_SESSION['email'];?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
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


include('sidebar.php');
?>

<main id="main" class="main">

    <!-- Alerts -->
    <?php
    if ($put_class) {
        echo "<div class='alert alert-danger text-center' role='alert'>Please enter the class name before creating.</div>";
    }

    if ($create_table) {
        echo "<div class='alert alert-success text-center' role='alert'>The class '$t_name' created successfully.</div>";
    }

    if ($alredy_table) {
        echo "<div class='alert alert-danger text-center' role='alert'>$error_message</div>";
    }
    ?>
    <!-- End Alerts -->

    <div class="pagetitle">
        <h1>Classes-Name</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Info</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6 mt-5">
                <h1>Create a New Class or Batch</h1>
                <form method="post">
                    <div class="form-group col-md-2">
                        <label for="inputZip">Class Name</label>
                        <input type="text" class="form-control" name="class-name" id="inputZip">
                    </div>
                    <button type="submit" name="add" class="btn btn-primary mt-3">Create</button>
                </form>
            </div>
        </div>

        <hr>

        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Classes Data</h5>
                        <table class="table table-lights table datatable">
                            <thead>
                                <tr>
                                    <th>Class-Name</th>
                                    <th></th>
                                    <th>Student Data</th>
                                    <th>Remove Class</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qur_tbl = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'student_management'";
                                $res_fatch_tbl = mysqli_query($con, $qur_tbl);

                                while ($row = mysqli_fetch_array($res_fatch_tbl)) {
                                    if (in_array($row['table_name'], ['student_attendance','videos','attendance', 'students', 'signup', 'teacher_details', 'student_fee', 'fee_user'])) {
                                        continue;
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $row['table_name']; ?></td>
                                        <td></td>

           <td><a class="btn btn-outline-info" href="add_student_form.php?table_name=<?php echo $row['table_name']; ?>"><i class="fa-solid fa-person"></i> View</a></td>
                                        
                                        <td>
    <a class="btn btn-danger" href="delete_class.php?table_name=<?php echo $row['table_name']; ?>" 
       onclick="return confirm('Are you sure you want to remove this class?');">
       <i class="fa-solid fa-trash"></i> Remove
    </a>
</td>  
<td></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php include('footer.php'); ?>

