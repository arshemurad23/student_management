<?php
session_start();

include('dbinfo.php');

$id = $_REQUEST['id'];

$_SESSION['tbl_name'];

$tbl_name = $_SESSION['tbl_name'] ; 

$student_tbl = "delete from students where id = '$id' ";
$res_student_tbl = mysqli_query($con,$student_tbl);

if($res_student_tbl == true){


$qur = "delete from $tbl_name where id = '$id' ";

$res = mysqli_query($con,$qur);

if($res == true){

    header('location:add_student_form.php?table_name='.$tbl_name);

}

}









?>