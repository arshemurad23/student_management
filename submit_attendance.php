<?php
session_start(); // Start the session
include("dbinfo.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendance'])) {
    $date = date('Y-m-d');
    $month_year = date('F Y');
    $attendanceSubmitted = false;
    foreach ($_POST['attendance'] as $student_id => $status) {
        // Initialize attendance status
        $attendance_status = '';
    
        // Determine the attendance status based on the submitted radio button value
        if (isset($status['status'])) {
            $attendance_status = $status['status'];
        }
    
        // Ensure attendance status is valid
        if (!in_array($attendance_status, ['leave', 'absent', 'present'])) {
            $attendance_status = 'present'; // Default if not valid (shouldn't occur with proper form setup)
        }
    
        // Sanitize inputs
        $name = mysqli_real_escape_string($con, $status['name']);
        $class = mysqli_real_escape_string($con, $status['class']);
    
        // Check if attendance for today already exists
        $checkQuery = "SELECT * FROM attendance WHERE id = '$student_id' AND date = '$date'";
        $result = mysqli_query($con, $checkQuery);
    
        if (mysqli_num_rows($result) == 0) {
            // Prepare the query
            $query = "INSERT INTO attendance (id, name, class, date, month_year, status) 
                      VALUES ('$student_id', '$name', '$class', '$date', '$month_year', '$attendance_status') 
                      ON DUPLICATE KEY UPDATE 
                      name = '$name', 
                      class = '$class', 
                      date = '$date', 
                      month_year = '$month_year', 
                      status = '$attendance_status'";
    
            // Execute the query and check for errors
            if (!mysqli_query($con, $query)) {
                echo "Error: " . mysqli_error($con);
            } else {
                $attendanceSubmitted = true;
            }
        } else {
            // Store alert message in session
            $_SESSION['attendance_alert'] = "Attendance for today has already been submitted for student ID: $student_id.";
            header("Location: fetch_addendace.php");
            exit; // Make sure to exit after redirection
        }
    }
    
    if ($attendanceSubmitted) {
        header("Location: fetch_addendace.php");
        exit;
    }
}
?>
