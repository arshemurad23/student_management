<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar bg-dark">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid text-dark"></i>
      <span class="text-dark">Home</span>
    </a>
  </li><!-- End Dashboard Nav -->

  
<!-- productions -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-journal-text text-dark"></i><span  class="text-dark">ADD Student & Batch</span><i class="bi bi-chevron-down ms-auto text-dark"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse  " data-bs-parent="#sidebar-nav">


    
     
      <li>
        <a href="add_batch.php">
          <i class="bi bi-circle"></i><span  class="text-light"> Add Batch or Class</span>
        </a>
      </li>
      <li>
        <a href="show_Teachers.php">
          <i class="bi bi-circle"></i><span  class="text-light">Teachers Details</span>
        </a>
      </li>
    </ul>
  </li><!-- End productions Nav -->




  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide text-dark"></i><span class="text-dark">Attendance System</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="attendace_class_sel.php">
              <i class="bi bi-circle"></i><span  class="text-light">Student Attendance</span>
            </a>
          </li>
        
          <li>
            <a href="fetch_addendace.php">
              <i class="bi bi-circle"></i><span  class="text-light">Attendance Records</span>
            </a>
          </li>


        </ul>
      </li><!-- End Components Nav -->





      <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#video-upload-nav" data-bs-toggle="collapse" href="#">
    <i class="fa-solid fa-video"></i></i><span class="text-dark">Online Class system</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="video-upload-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="upload_video.php">
                <i class="bi bi-circle"></i><span class="text-light">Upload Video & detales </span>
            </a>
        </li>
        <li>
            <a href="fetch_video.php">
                <i class="bi bi-circle"></i><span class="text-light">Upload Records</span>
            </a>
        </li>
    </ul>
</li><!-- End 

















  <!-- testing -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse text-dark"></i><span class="text-dark">Fees Management</span><i class="bi bi-chevron-down ms-auto text-dark"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="student_fee_class_view.php">
          <i class="bi bi-circle"></i><span class="text-light">Student Fee Submit</span>
        </a>
      </li>
      <li>
        <a href="student_fee_view.php">
          <i class="bi bi-circle"></i><span class="text-light">Student Fee Data View</span>
        </a>
      </li>
      
    </ul>
  </li><!-- End Testing Nav -->

  
  
  <li class="nav-heading">Pages</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.php">
      <i class="bi bi-person text-dark"></i>
      <span class="text-dark">Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-register.php">
      <i class="bi bi-card-list text-dark"></i>
      <span  class="text-dark">Register</span>
    </a>
  </li><!-- End Register Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-login.php">
      <i class="bi bi-box-arrow-in-right text-dark"></i>
      <span  class="text-dark">Login</span>
    </a>
  </li><!-- End Login Page Nav -->

  
</ul>

</aside><!-- End Sidebar-->