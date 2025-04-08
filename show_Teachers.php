


<?php
include('navbar.php');
?>
<?php

include("dbinfo.php");
$qur = "select * from teacher_details";
$res = mysqli_query($con,$qur);


?>

<?php
include('sidebar.php');
?>







<main id="main" class="main">

<div class="pagetitle">
  <h1>teachers-details</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Info</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<section class="section dashboard">
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Classes Data</h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Teacher ID</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_array($res)) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td>
                                             </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  </main><!-- End #main -->



  <?php
  include('footer.php');
  ?>
  