<?php
include("dbinfo.php");
include('navbar.php');
include('sidebar.php');
?>

<?php
             
                ?>

<main id="main" class="main">
<?php
   if (isset($_SESSION['create_alert'])) {
    echo '<div class="alert alert-warning">' . $_SESSION['create_alert'] . '</div>';
    unset($_SESSION['create_alert']); // Clear the alert after showing
}

?>

    <div class="pagetitle">
        <h1>Home</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Info</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

        <h1>TOTALES</h1>
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <?php
                    $total_class_qur = "SELECT COUNT(*) AS table_count FROM information_schema.tables WHERE table_schema = 'student_management'"; 
                    $total_class_res = mysqli_query($con, $total_class_qur);

                    // Fetch the result
                    if ($total_class_row = mysqli_fetch_assoc($total_class_res)) {
                        $total_tables = $total_class_row['table_count'];
                    } else {
                        $total_tables = 0; // Default to 0 if the query fails
                    }
                    ?>

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                        <li><a class="dropdown-item" href="classes.php">Classes</a></li>
                                      
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Classes <span></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-landmark"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $total_tables - 7; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Revenue Card -->

                    <?php
                    $total_student = "SELECT * from students"; 
                    $total_student_res = mysqli_query($con, $total_student);
                    $total_student_row = mysqli_num_rows($total_student_res);
                    ?>

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="totale_students.php" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="totale_students.php">Totale Students</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Students <span></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $total_student_row ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <?php
                    $toale_teacher = "SELECT * from teacher_details";
                    $toale_teacher_res = mysqli_query($con, $toale_teacher);
                    $toale_teacher_row = mysqli_num_rows($toale_teacher_res);
                    ?>

                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="show_Teachers.php">Teachers Recods</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Teachers <span></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-person-circle-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $toale_teacher_row ?></h6>
                                    </div>
                                </div>
                            </div>              
                        </div>
                    </div><!-- End Customers Card -->

                </div>
            </div>
        </div>

    

    </section>
                                                                     <!-- section2end -->
<!-- ====================================================================================----------------------------------------------------------------- -->

    <section class="section dashboard">
        <div class="row">
        <h1>TODAY / MONTH</h1>
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                <?php

$today = date("Y-m-d");

$total_present_qur = "SELECT COUNT(*) AS present_count FROM attendance WHERE date = '$today' AND status = 'present';"; 
$total_present_res = mysqli_query($con, $total_present_qur);

// Check if the query was successful
if ($total_present_res) {
    // Fetch the result
    $total_present_row = mysqli_fetch_array($total_present_res);
    $total_present_count = $total_present_row['present_count']; // Use the alias to get the count
} else {
    $total_present_count = 0; // Handle error or set to zero if query fails
}

?>

<div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                    <li><a class="dropdown-item" href="fetch_addendace.php">Present Today</a></li>

                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">Totale Students Present Today <span></span></h5>
            <div class="d-flex align-items-center">
                <div class="text-warning card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="  fa-brands fa-product-hunt"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo htmlspecialchars($total_present_count); ?></h6>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Revenue Card -->

<!-- --------------------------------------------============================================== -->


<?php
// Get the current month and year
$current_month = date('m');
$current_year = date('Y');

// Query to count fees submitted in the current month
$total_fee_qur = "SELECT * FROM student_fee WHERE MONTH(fee_date) = '$current_month' AND YEAR(fee_date) = '$current_year'";
$total_fee_res = mysqli_query($con, $total_fee_qur);
$total_fee_row = mysqli_num_rows($total_fee_res);
?>

<div class="col-xxl-4 col-md-6">
    <div class="card info-card revenue-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                    <li><a class="dropdown-item" href="student_fee_view.php">This Month fees</a></li>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <h5 class="card-title">Total Student Submit Fees This Month <span></span></h5>
            <div class="d-flex align-items-center">
                <div class="btn btn-dark card-icon rounded-circle d-flex align-items-center justify-content-center text-dark">
                    <i class="fa-regular fa-money-bill-1"></i>
                </div>
                <div class="ps-3">
                    <h6><?php echo htmlspecialchars($total_fee_row); ?></h6>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Revenue Card -->


    </section>




</main><!-- End #main -->

<?php
include('footer.php');
?>

