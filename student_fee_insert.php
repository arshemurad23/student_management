<?php
session_start(); // Make sure session is started
include('dbinfo.php');

if (isset($_POST['add'])) {
    $student_id = $_POST['student_id'];
    $fee = $_POST['fee'];
    $today = date("Y-m-d");
    $current_month = date("Y-m");

    // Validate the fee and student ID
    if ($student_id != "" && $fee != "") {
        // Check if the student exists
        $student_check_query = "SELECT * FROM students WHERE id = '$student_id'";
        $student_check_result = mysqli_query($con, $student_check_query);

        if (mysqli_num_rows($student_check_result) === 0) {
            echo "<script>alert('Invalid Student ID. Fee submission failed.');</script>";
        } else {
            // Check if fee has already been submitted for the current month
            $check_query = "SELECT * FROM student_fee WHERE student_id = '$student_id' AND DATE_FORMAT(fee_date, '%Y-%m') = '$current_month'";
            $check_result = mysqli_query($con, $check_query);

            if (mysqli_num_rows($check_result) > 0) {
                // Set session variable instead of alerting directly
                $_SESSION['fee_alert'] = 'Fee has already been submitted for this month.';
                header('Location: student_fee_view.php ');
            } else {
                // Prepare the insert query
                $query = "INSERT INTO student_fee (student_id, fee, fee_date) VALUES ('$student_id', '$fee', '$today')";
                $result = mysqli_query($con, $query);
                
                if ($result) {
                    // Send email notification logic
                    $email_query = "SELECT email FROM students WHERE id = '$student_id'";
                    $email_result = mysqli_query($con, $email_query);
                    $email_row = mysqli_fetch_assoc($email_result);
                    $email = $email_row['email'];

                    if ($email) {
                        mail($email, "Student Management Fee Submitted", "Thank you! Your monthly fee of $fee has been submitted.", "From: arshemurad@gmail.com");
                    }

                    header('Location: student_fee_view.php');
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        }
    } else {
        echo "Student ID and Fee are required.";
    }
}
?>
