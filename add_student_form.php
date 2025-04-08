


<?php
include('navbar.php');
?>

<?php
include('sidebar.php');
?>

<?php
$tbl_name = $_REQUEST['table_name'];
$_SESSION['tbl_name'] = $tbl_name;
?>

  <main id="main" class="main">

  
  
  


    <div class="pagetitle">
      <h1>Student-Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><?php echo  $tbl_name ?> <a href="index.php"></a></li>
          <li class="breadcrumb-item active">Info</li>
        </ol>
        
      </nav>
      
    </div><!-- End Page Title -->


    <section class="section dashboard">

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title d-flex justify-content-between align-items-center">
                Datatables
                <a href="student_data_insert.php?tbl_name=<?php echo $tbl_name ?>" class="btn btn-outline-primary">
                    <i class="fa-solid fa-person-circle-plus"></i> Add Student
                </a>
            </h5>

            <?php
            include("dbinfo.php");
            $sel_qur = "SELECT * FROM $tbl_name";
            $sel_res = mysqli_query($con, $sel_qur);
            ?>

            <!-- Table with striped rows -->
            <div class="table-responsive">
                <table class="table table-striped datatable" style="min-width: 800px;">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Create Date</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($sel_res)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['live_date']; ?></td>
                                <td>
                                    <a href="update_studen_data.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="delete_studen_data.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with striped rows -->

        </div>
    </div>
</div>

</section>

  </main><!-- End #main -->



  <?php
  include('footer.php');
  ?>
  