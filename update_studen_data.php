<?php
include('navbar.php');
?>

<?php

$_SESSION['tbl_name'];

$tbl_name = $_SESSION['tbl_name'] ;
?>




<?php
include('sidebar.php');
?>


  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update-Student-</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><?php echo    $tbl_name ?> </a></li>
          <li class="breadcrumb-item active">Info</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">

<?php
include("dbinfo.php");

$id = $_REQUEST['id'];
$qur = "SELECT * FROM $tbl_name WHERE id = '$id'";
$res = mysqli_query($con, $qur);
$row = mysqli_fetch_array($res);
?>

<div class="container d-flex justify-content-center mt-4">
    <div class="card" style="width: 700px;">
        <div class="card-body">
            <h1 class="text-center">Update Class <?php echo $tbl_name; ?> Student Data</h1>

            <form action="B_update_student.php" class="row g-3 mt-5" method="post" enctype="multipart/form-data">

                <div class="col-12">
                    <label for="inputId" class="form-label">Enter Student ID</label>
                    <input type="text" name="id" value="<?php echo $row['id']; ?>" class="form-control" id="inputId" readonly>
                </div>

                <div class="col-12">
                    <label for="inputName" class="form-label">Enter Student Name</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" id="inputName" required>
                </div>

                <div class="col-12">
                    <label for="inputEmail" class="form-label">Student Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" id="inputEmail" required>
                </div>

                <div class="col-12">
                    <label for="inputCourse" class="form-label">Student Course</label>
                    <input type="text" name="course" value="<?php echo $row['course']; ?>" class="form-control" id="inputCourse" required>
                </div>

                <div class="col-12 text-center">
                    <button type="submit" name="update" class="btn btn-primary mt-2">Update</button>
                </div>
            </form>

        </div>
    </div><!-- End Default Card -->
</div>

</section>

  </main><!-- End #main -->



  <?php
  include('footer.php');
  ?>
