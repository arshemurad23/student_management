

<?php include('navbar.php'); ?>
<?php include('sidebar.php'); ?>
<?php

$tbl_name = $_REQUEST['table_name'];
$_SESSION['tbl_name'] = $tbl_name;
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Attendance  Student Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo $tbl_name; ?> <a href="index.php"></a></li>
                <li class="breadcrumb-item active">Student Attendance</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Attendance Data</h5>

            <?php
            include("dbinfo.php");
            $sel_qur = "SELECT * FROM students WHERE class = '$tbl_name'";
            $sel_res = mysqli_query($con, $sel_qur);
            ?>

            <!-- Table with stripped rows -->
            <form method="post" action="submit_attendance.php">
    <div class="table-responsive">
        <table class="table table-striped table-bordered datatable">
            <thead class="thead-light">
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Leave</th>
                    <th>Absent</th>
                    <th>Present</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($sel_res)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>

                        <td>
                            <input type="hidden" name="attendance[<?php echo $row['id']; ?>][name]" value="<?php echo htmlspecialchars($row['name']); ?>">
                            <?php echo htmlspecialchars($row['name']); ?>
                        </td>

                        <td>
                            <input type="hidden" name="attendance[<?php echo $row['id']; ?>][class]" value="<?php echo htmlspecialchars($row['class']); ?>">
                            <?php echo htmlspecialchars($row['class']); ?>
                        </td>

                        <td>
                            <input type="radio" name="attendance[<?php echo $row['id']; ?>][status]" value="leave">
                        </td>
                        <td>
                            <input type="radio" name="attendance[<?php echo $row['id']; ?>][status]" value="absent">
                        </td>
                        <td>
                            <input type="radio" name="attendance[<?php echo $row['id']; ?>][status]" value="present" checked>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit Attendance</button>
</form>

            <!-- End Table with stripped rows -->
        </div>
    </div>
</section>

</main><!-- End #main -->

<?php include('footer.php'); ?>
