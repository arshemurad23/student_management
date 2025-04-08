<?php
include('navbar.php');
include('sidebar.php');?>





<main id="main" class="main">

  

  


<div class="pagetitle">
  <h1>Student Fee -Data</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Fee System</a></li>
      <li class="breadcrumb-item active">Info</li>
    </ol>
    
  </nav>
  
</div><!-- End Page Title -->



<section class="section dashboard   ">




        

         
         



       
          <!-- Large Modal -->
       

         


                                    
          
          
          
                                             <!-- START TABLE -->



      <div class="card">


        <div class="card-body">

          <h5 class="card-title">Datatables</h5>

          <?php
include("dbinfo.php");
$sel_qur = "SELECT * FROM students";
$sel_res = mysqli_query($con, $sel_qur);
?>

<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th>Student Id</th>
            <th>Name</th>
            <th>Course</th>
            <th>Email</th>
            <th>Fee</th>
            <th>Class</th>
            <th>Start Date</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_array($sel_res)) {
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['coures']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td> <?php echo $row['fee']; ?></td>
                <td><?php echo $row['class']; ?></td>
                <td><?php echo $row['live_date']; ?></td>
                <td>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
          






</section>
</main><!-- End #main -->














<?php
  include('footer.php');
  ?>
