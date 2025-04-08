<?php


include('navbar.php');
include('sidebar.php');
include("dbinfo.php");

// Initialize variables for filtering
$class = $_POST['class'] ?? '';
$date = $_POST['date'] ?? '';

// Prepare SQL query based on selected filters
$sel_qur = "SELECT * FROM attendance WHERE 1=1";
$conditions = [];

if ($class) {
    $conditions[] = "class = '$class'";
}

if ($date) {
    $conditions[] = "date = '$date'";
}

// Add conditions only if both class and date filters are present
if (count($conditions) > 0) {
    $sel_qur .= " AND " . implode(' AND ', $conditions);
}

// Debugging: Output the final query
// echo $sel_qur; // Uncomment this line to see the SQL query

if ($sel_qur) {
    $sel_res = mysqli_query($con, $sel_qur);
    
    // Check for query error
    if (!$sel_res) {
        echo "Error in query: " . mysqli_error($con);
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Student Attendance - Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Student Attendance</a></li>
                <li class="breadcrumb-item active">Info</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filter Attendance Data</h5>
                <?php
                
// Check for alert message
if (isset($_SESSION['attendance_alert'])) {
    echo '<div class="alert alert-warning">' . $_SESSION['attendance_alert'] . '</div>';

    unset($_SESSION['attendance_alert']); // Clear the message after displaying it
}

                ?>
                <form method="POST" action="" onsubmit="return validateForm()">
                    <label for="class">Class:</label>
                    <select name="class" id="class">
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
                        <option value="<?php echo $table_value; ?>" <?php echo ($class == $table_value) ? 'selected' : ''; ?>><?php echo $table_value; ?></option>
                        <?php
                        }
                        ?>
                    </select>

                    <label for="date">Date:</label>
                    <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($date); ?>">

                    <button type="submit">Filter</button>
                </form>

                <h5 class="card-title">Attendance Data</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Student Id</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($sel_res) && mysqli_num_rows($sel_res) > 0) {
                            while ($row = mysqli_fetch_array($sel_res)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['class']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="5">No records found. Please select a class and a date.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<script>
function validateForm() {
    const classSelect = document.getElementById('class');
    const dateInput = document.getElementById('date');
    
    if (classSelect.value === '') {
        alert('Please select a class before submitting.');
        return false; // Prevent form submission
    }
    
    if (dateInput.value === '') {
        alert('Please select a date before submitting.');
        return false; // Prevent form submission
    }
}
</script>

<?php include('footer.php'); ?>
