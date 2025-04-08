<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php
$id = $_REQUEST['id'];
include("dbinfo.php");

// Fetch fee details
$qur = "SELECT * FROM student_fee WHERE fee_id = '$id'"; // Assuming fee_id is the correct identifier
$res = mysqli_query($con, $qur);

// Check if any rows are returned
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_array($res);
} else {
    echo "<h2>No data found for the provided ID.</h2>";
    exit();
}

// Fetch student details using student_id from the fee record
$student_id = $row['student_id']; // Assuming this is the correct key in student_fee
$std_qur = "SELECT * FROM students WHERE id = '$student_id'";
$std_res = mysqli_query($con, $std_qur);

// Check if student data is returned
if (mysqli_num_rows($std_res) > 0) {
    $std_row = mysqli_fetch_array($std_res);
} else {
    echo "<h2>No student data found for the provided ID.</h2>";
    exit();
}
?>

<div class="container">
    <center>
        <div class="row mt-5">
            <h1 class="display-5 text-center">Student Management System</h1>
            <div class="col-xl-12">
                <div class="receipt-header receipt-header-mid">
                    <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                        <div class="receipt-right">
                            <p><b>Student ID:</b> <?php echo $std_row['id']; ?></p>
                            <p><b>Student Name:</b> <?php echo $std_row['name']; ?></p>
                            <p><b>Student Class Name:</b> <?php echo $std_row['class']; ?></p>
                            <p><b>Course:</b> <?php echo $std_row['coures']; ?></p>
                            <p><b>Email:</b> <?php echo $std_row['email']; ?></p>
                            <p><b>Fee Pay Date:</b> <?php echo $row['fee_date']; ?></p>
                        </div>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <div class="receipt-left">
                            <h3>INVOICE # 102</h3>
                        </div>
                    </div>
                </div>
            </div>
        </center>

        <center>
            <div style="width: 500px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-9">Submit Fee</td>
                            <td class="col-md-3"><i class="fa fa-inr"></i> <?php echo $row['fee']; ?>-</td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                <p><strong>Total Amount:</strong></p>
                                <p><strong>Late Fees:</strong></p>
                                <p><strong>Payable Amount:</strong></p>
                                <p><strong>Balance Due:</strong></p>
                            </td>
                            <td>
                                <p><strong><i class="fa fa-inr"></i> 65,500/-</strong></p>
                                <p><strong><i class="fa fa-inr"></i> 500/-</strong></p>
                                <p><strong><i class="fa fa-inr"></i> 1300/-</strong></p>
                                <p><strong><i class="fa fa-inr"></i> 0.00-</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right"><h2><strong>Total:</strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> 31,566/-</strong></h2></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </center>
    </div>
</div>

<center>
    <a href="student_fee_view.php" class="btn btn-danger">Back</a>
    <a onclick="window.print()" class="btn btn-info">Print</a>
</center>

</body>
</html>
