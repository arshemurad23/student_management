<?php

// Include necessary files
include('navbar.php');
include('sidebar.php');
include("dbinfo.php");

// Initialize variables
$date_filter = isset($_POST['date_filter']) ? $_POST['date_filter'] : '';

// Fetch student fee data with optional date filtering
$sel_qur = "SELECT * FROM student_fee" . ($date_filter ? " WHERE DATE(fee_date) = '$date_filter'" : "");
$sel_res = mysqli_query($con, $sel_qur);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Student Fee - Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Fee System</a></li>
                <li class="breadcrumb-item active">Info</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Datatables</h5>

            <!-- Display alert if set -->
            <?php if (isset($_SESSION['fee_alert'])): ?>
                <div class="alert alert-warning">
                    <?php echo htmlspecialchars($_SESSION['fee_alert']); ?>
                </div>
                <?php unset($_SESSION['fee_alert']); // Clear the alert after showing ?>
            <?php endif; ?>

            <!-- Date Filter Form -->
            <form method="post" class="mb-3">
                <div class="input-group">
                    <label for="date_filter" class="input-group-text">Select Date:</label>
                    <input type="date" id="date_filter" name="date_filter" class="form-control" value="<?php echo htmlspecialchars($date_filter); ?>">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

            <!-- Table with stripped rows -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>Student Id</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Class Name</th>
                            <th>Student Fee</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($sel_res)): ?>
                            <?php
                            $std_qur = "SELECT * FROM students WHERE id = '" . mysqli_real_escape_string($con, $row['student_id']) . "'";
                            $std_res = mysqli_query($con, $std_qur);
                            ?>

                            <?php if ($std_row = mysqli_fetch_array($std_res)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($std_row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($std_row['coures']); ?></td>
                                    <td><?php echo htmlspecialchars($std_row['class']); ?></td>
                                    <td>Submitted - <?php echo htmlspecialchars($row['fee']); ?></td>
                                    <td>
                                        <a href="print_pdf.php?id=<?php echo urlencode($row['fee_id']); ?>" class="btn btn-info">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->
        </div>
    </div>
</section>

</main><!-- End #main -->

<?php
include('footer.php');
?>
