
<?php
include('navbar.php');
?>

<?php
include('sidebar.php');
?>


  

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Fee Submit Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Fee system</a></li>
          <li class="breadcrumb-item active">Info</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section dashboard">
    <?php
    $_SESSION['tbl_name'];
    $fee_tbl_name = $_SESSION['tbl_name'];
    include("dbinfo.php");

    $id = $_REQUEST['id'];
    $qur = "SELECT * FROM $fee_tbl_name WHERE id = '$id'";
    $res = mysqli_query($con, $qur);
    $row = mysqli_fetch_array($res);
    ?>

    <div class="d-flex justify-content-center">
        <div class="card" style="width: 700px;">
            <div class="card-body">
                <h1 class="text-center">Fee Submit for <?php echo htmlspecialchars($fee_tbl_name); ?> Student</h1>

                <form method="POST" action="student_fee_insert.php">
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo htmlspecialchars($id); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="fee" class="form-label">Monthly Fee</label>
                        <input type="text" class="form-control" id="fee" name="fee" value="<?php echo htmlspecialchars($row['fees']); ?>" required>
                    </div>

                    <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div><!-- End Default Card -->
    </div>
</section>

  </main><!-- End #main -->



  <?php
  include('footer.php');
  ?>
  