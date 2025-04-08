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

include('navbar.php');
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
                                    <th></th>
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
                                        <td></td>
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
