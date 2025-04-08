<?php
$id = $_REQUEST['id'];
include('dbinfo.php');

$qur = "delete from student_fee where std_id = '$id' ";

$res = mysqli_query($con,$qur);

if($res == true){

    header('location:student_fee_view.php');

}
