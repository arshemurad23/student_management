<?php
session_start();

if (!isset($_SESSION['tbl_name'])) {
    // Redirect or handle the error if tbl_name is not set
    die("Table name not set.");
}

$tbl_name = $_SESSION['tbl_name'];
include("dbinfo.php");

if (isset($_POST['update'])) { // Changed 'add' to 'update' to match form action
    $roll = $_POST['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    // Check if all fields are filled
    if (!empty($name) && !empty($email) && !empty($course)) {
        // Update in students table
        $students_tbl = "UPDATE students SET name = '$name', coures = '$course', email = '$email' WHERE id = '$roll'";
        $students_res = mysqli_query($con, $students_tbl);

        // Check if the query was successful
        if ($students_res) {
            // Update in the specific table
            $update_qur = "UPDATE $tbl_name SET name = '$name', course = '$course', email = '$email' WHERE id = '$roll'";
            $update_res = mysqli_query($con, $update_qur);

if($update_res == true){


$qur_attendance = "UPDATE attendance SET name = '$name' WHERE id = '$roll'";
$res_attendance = mysqli_query($con, $qur_attendance);


            // Check if the update was successful
            if ($res_attendance == true) {
                header('Location: add_student_form.php?table_name=' . $tbl_name);
             
                exit(); // Use exit() after header redirection
            }
           }
        }
       }
    }


?>
