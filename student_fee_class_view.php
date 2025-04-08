<?php
session_start();

// Check if the session variable 'name' is set and not empty
if (!isset($_SESSION['name']) || $_SESSION['name'] === '') {
    header('Location: pages-login.php');
    exit(); // Make sure to call exit after a redirect
}

// Check if the user is either 'admin' or 'Fee System'
if ($_SESSION['name'] !== 'admin' && $_SESSION['name'] !== 'Fee System') {
    header('Location: fee-system-login.php');
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

    <div class="pagetitle">
      <h1> Classes Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Fee system</a></li>
          <li class="breadcrumb-item active">Info</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


<section class="section dashboard">


<div class="row mt-5">
<div class="col-lg-12">


         <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Totale Classes Data</h5>



<!-- // SELECT COUNT(*) AS table_count FROM information_schema.tables WHERE table_schema = 'student_management'; -->

            <!-- //  $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'student_management'"; -->
            <!-- //   $res_fatch_tbl = mysqli_query($sql,$con); -->

         

              <table class="table table-lights table datatable">

<?php
include("dbinfo.php");
             
$qur_tbl = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'student_management' ";
$res_fatch_tbl = mysqli_query($con,$qur_tbl);
                ?>

<thead>
<tr>
                   
                  <th>  Class-Name</th>
                    <th></th>
                    <th></th>

                    <th data-type="date" data-format="YYYY/DD/MM"></th>
                    <th>Student Data</th>

                </tr>
                </thead>

                <tbody>
  
  <?php
       while ($row = mysqli_fetch_array($res_fatch_tbl)) {
        if (in_array($row['table_name'], ['student_attendance','videos','attendance', 'students', 'signup', 'teacher_details', 'student_fee', 'fee_user'])) {
          continue;
      
        }
    
   
                ?>
  
  <tr>
                  <td><?php echo $row['table_name'] ?></td>
                  <td></td>
                  <td></td>
                  <td></td>

                  <td><a class="btn  btn-outline-info" href="student_fee_recode.php?table_name=<?php echo $row['table_name'] ?>"><i class="fa-solid fa-person"></i>View</a></td>
                  

                  </tr>

<?php
}
?>

                </tbody>
              </table>
              <!-- End Dark Table -->

            </div>
          </div>

              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>






</section>
  </main><!-- End #main -->



  <?php
  include('footer.php');
?>


