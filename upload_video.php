<?php

include("dbinfo.php");
require 'vendor/autoload.php'; // Include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$alert = false;
$no_students_alert = '';

if (isset($_POST['add'])) {
    // Assume $con is your MySQL connection
    $teacher_id = mysqli_real_escape_string($con, $_POST['teacher_id']);
    $techar_name = mysqli_real_escape_string($con, $_POST['techar_name']);
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $masg = mysqli_real_escape_string($con, $_POST['masg']);

    $video = $_FILES['video']['name'];
    $tpm_video = $_FILES['video']['tmp_name'];
    $folder = 'assets/video/' . basename($video);
    move_uploaded_file($tpm_video, $folder);

    $date = date('Y-m-d');

    // Query to get emails of students who were present in the specified class
    $clas_qur = "
        SELECT students.id, students.name, students.email 
        FROM students
        JOIN attendance ON students.id = attendance.id 
        WHERE attendance.date = '$date' 
          AND attendance.status = 'present' 
          AND attendance.class = '$class';
    ";
    $clas_res = mysqli_query($con, $clas_qur);

    // Check if any students were found
    if (mysqli_num_rows($clas_res) > 0) {
        // Insert the video information into the database
        $que = "INSERT INTO videos VALUES (NULL, '$teacher_id', '$techar_name', '$class', '$masg', '$video', '$date')";
        $insert_res = mysqli_query($con, $que);
        
        if ($insert_res) {
            $alert = true;

            // Loop through each present student and send an email
            while ($clas_row = mysqli_fetch_array($clas_res)) {
                $email = $clas_row['email'];
                
                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
                
                try {
                    // Server settings
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'arshemurad@gmail.com';          // SMTP username
                    $mail->Password = 'sjhe ymji gfgk iziy';                   // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                   // TCP port to connect to

                    // Recipients
                    $mail->setFrom('arshemurad@gmail.com', 'Your Name');
                    $mail->addAddress($email);                           // Add a recipient

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = "Student Management Online Class Video";
                    $mail->Body = "Dear Student,<br>$masg";

                    // Attach the video file
                    $mail->addAttachment($folder);                       // Add attachments

                    // Send the email
                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    } else {
        // Set an alert if no students are found
        $no_students_alert = "Attendance is not marked yet or any student is not there, first get the attendance marked and then submit.";
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
if ( $_SESSION['name'] == 'Fee System') {
    header('Location: facultys-loging.php');
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
        <h1>Omline Class system</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Info</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <?php if ($alert) {
        echo '<div class="alert alert-warning">Message & Video uploaded successfully!</div>';
    } ?>

    <?php if ($no_students_alert) {
        echo '<div class="alert alert-danger">' . $no_students_alert . '</div>';
    } ?>

    <div class="container d-flex justify-content-center align-items-center" style="height: auto;">
        <div class="card" style="width: 800px; margin-top: 20px;">
            <div class="card-body">
                <h5 class="card-title text-center">Upload Video</h5>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="teacher_id">Teacher ID:</label>
                        <input type="text" value="<?php echo $_SESSION['id']; ?>" class="form-control" id="teacher_id" name="teacher_id" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="techar_name">Teacher Name:</label>
                        <input type="text" value="<?php echo $_SESSION['name']; ?>" class="form-control" id="techar_name" name="techar_name" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="class">Class:</label>
                        <select name="class" id="class" required>
                            <option value="">Select Class</option>
                            <?php
                            $qur_tbl = "SELECT table_name FROM information_schema.tables WHERE table_schema = 'student_management'";
                            $res_fatch_tbl = mysqli_query($con, $qur_tbl);

                            while ($tbl_name = mysqli_fetch_array($res_fatch_tbl)) {
                                if (in_array($tbl_name['table_name'], ['student_attendance','videos', 'attendance', 'students', 'signup', 'teacher_details', 'student_fee', 'fee_user'])) {
                                    continue;
                                }
                                $table_value = $tbl_name['table_name'];
                            ?>
                                <option value="<?php echo $table_value; ?>"><?php echo $table_value; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mt-3">
    <label for="message">Message:</label>
    <textarea class="form-control" id="message" name="masg" rows="4" required></textarea>
</div>

                    <div class="form-group mt-4">
                        <label for="video">Video:</label>
                        <input type="file" class="form-control-file" id="video" name="video" required>
                    </div>

                    <button type="submit" name="add" class="btn btn-success btn-block mt-4">Upload Video</button>
                </form>
            </div>
        </div>
    </div>

   
</main><!-- End #main -->

<?php
include('footer.php');
?>


