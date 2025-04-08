<?php
session_start();
$_SESSION['name'];
$name = $_SESSION['name'];

if ($name != 'admin') {
  $_SESSION['create_alert'] = "only can Admin cilck"; 
  header('location:index.php');
  exit;
}
?>


<?php

include('dbinfo.php');
$alert = false ; 
if(isset($_POST['add'])){
  $fname = $_POST['fname'];
  $email = $_POST['email'];
  $uname = $_POST['uname'];
  $pname = $_POST['pname'];

$img = $_FILES['pic']['name'];
$tpm_img = $_FILES['pic']['tmp_name'];
$folder = 'assets/img/' . $img ; 
move_uploaded_file($tpm_img,$folder);


  $pass = $_POST['pass'];
  $cpass = $_POST['cpass'];

  if($pass == $cpass){

  if($fname != "" && $email != "" && $uname != "" &&   $pname != "" && $pass != "" && $cpass != ""){

  $que = "insert into teacher_details values(null, '$fname' , '$email' , '$uname'  , '$pname' ,'$img', '$pass' , '$cpass')";
  
  $res = mysqli_query($con,$que);
  if($res == true){
    header('location:index.php');
  }

}
}else{
  $alert = true ;
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register -Student Management system</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

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

<body class="bg-dark">

<?php
  if($alert){
  echo "<div class='alert alert-danger text-center' role='alert'>
  pelese chek passwrod & confrom_password it's not match
  </div>";
  }
?>



  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block text-light">Student Management</span>

                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Only Admin Create an Account For Teachers </p>
                  </div>

                  <form class="row g-3 needs-validation" method="post" enctype="multipart/form-data" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="fname" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="uname" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <!-- no need add -->

                    

                    <!-- no need add -->

                    <div class="col-12">
                      <label for="yourName" class="form-label">Enter Your primary school name</label>
                      <input type="text" name="pname" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, type  yourprimary school name!</div>
                    </div>


                    
                    <div class="col-12">
                      <label  class="form-label">select photo</label>
                      <input type="file" name="pic" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please select photo!</div>
                    </div>


                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="pass" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confrim Password</label>
                      <input type="password" name="cpass" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter again your password!</div>
                    </div>
                                        
                    
                    <div class="col-12">
                      <button name="add" class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="pages-login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                  Designed by <a href="#"> Apna Group</a>
                  </div>

            </div>
          </div>
        </div>

      </section>

    </div>
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