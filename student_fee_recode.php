<?php
include('navbar.php');
?>

<?php
include('sidebar.php');
?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Fee Detailes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Fee System</a></li>
          <li class="breadcrumb-item active">Info</li>
        </ol>
      </nav>      
    </div><!-- End Page Title -->
    <section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Datatables</h5>

            <?php
            $fee_tbl_name = $_REQUEST['table_name'];
            $_SESSION['tbl_name'] = $fee_tbl_name;

            include("dbinfo.php");
            $sel_qur = "SELECT * FROM $fee_tbl_name";
            $sel_res = mysqli_query($con, $sel_qur);
            ?>

            <!-- Table with stripped rows -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>Student Id</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Student Fee</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($sel_res)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['course']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['fees']); ?></td>
                                <td>
                                    <a href="student_fee_submit.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-warning">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->
        </div>
    </div>
</section>

  </main><!-- End #main -->



  <?php
  include('footer.php');
  ?>
  