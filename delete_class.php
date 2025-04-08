<?php

include('dbinfo.php');

$tbl_name = $_REQUEST['table_name'];

$qur = "drop table $tbl_name ";
$res = mysqli_query($con,$qur);

if($res == true){

$studnet_class = "delete from students where class = '$tbl_name'";
$studnet_res = mysqli_query($con,$studnet_class);

if($studnet_res == true){

header('location:add_batch.php');

}
}

?>


