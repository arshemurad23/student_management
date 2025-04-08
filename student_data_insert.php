<?php
$email_alert = false;
$tbl_name = $_REQUEST['tbl_name'];
include("dbinfo.php");

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $fees = $_POST['fees'];
    $today = date("Y-m-d");

    if ($name != "" && $course != "" && $email != "" && $fees != "") {
        // Attempt to insert student data
        $student_tbl = "INSERT INTO students VALUES (null, '$name', '$course', '$email', '$fees', '$tbl_name', '$today')";
        
        try {
            $student_res = mysqli_query($con, $student_tbl);
            
            // If insert was successful, proceed to the next step
            if ($student_res) {
                // ----========================================================================
                $class_qur = "SELECT * FROM students WHERE email = '$email'";
                $class_res = mysqli_query($con, $class_qur);
                $row = mysqli_fetch_array($class_res);
                $std_id = $row['id'];
                $std_name = $row['name'];
                $std_course = $row['coures'];
                $std_email = $row['email'];
                $std_fee = $row['fee'];
                $std_date = $row['live_date'];

                // ----========================================================================
                $qur = "INSERT INTO $tbl_name VALUES ('$std_id', '$std_name', '$std_course', '$std_email', '$std_fee', '$std_date')";
                $res = mysqli_query($con, $qur);

                if ($res) {
                    header('location:add_student_form.php?table_name=' . $tbl_name);
                    exit; // Exit after redirection
                }
            }
        } catch (mysqli_sql_exception $e) {
            // Handle the error: Show an alert or message
            $email_alert = true;
        }
    }
}
?>

<?php
include('navbar.php');
include('sidebar.php');
?>

<main id="main" class="main">

    <div class="pagetitle">
<?php

if ($email_alert) {
  echo "<div class='alert alert-danger text-center' role='alert'>This Student This is student already exist or also email.</div>";
}?>

        <h1>Enter-New-Student-Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?php echo htmlspecialchars($tbl_name); ?></a></li>
                <li class="breadcrumb-item active">Info</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container d-flex justify-content-center mt-4">
            <div class="card" style="width: 700px;">
                <div class="card-body">
                    <h1 class="mt-2 text-center">Enter Student Data</h1>
                    
                    <form class="row g-3 mt-5" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <label for="inputName" class="form-label">Enter Student Name</label>
                            <input type="text" name="name" class="form-control" id="inputName" required>
                        </div>

                        <div class="col-12">
                            <label for="inputCourse" class="form-label">Student Course</label>
                            <input type="text" name="course" class="form-control" id="inputCourse" required>
                        </div>

                        <div class="col-12">
                            <label for="inputEmail" class="form-label">Student Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" required>
                        </div>

                        <div class="col-12">
                            <label for="inputFees" class="form-label">Student Fees</label>
                            <input type="text" name="fees" class="form-control" id="inputFees" required>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" name="add" class="btn btn-primary mt-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- End Default Card -->
        </div>
    </section>
</main><!-- End #main -->

<?php
include('footer.php');
?>
