<?php
$title = "Dashboard | CMP 319 Assignment";
include 'header.php';
include '../includes/dbconn.php';
$active3 = "active";
$active2 = "";
$active1 = "";
include 'sidebar.php';


if (isset($_POST['submit'])) {
    $matric = $_POST['matric_no'];

    $select = "SELECT * FROM late_submit WHERE matric_no = '$matric'";
    $query = mysqli_query($mysqli, $select);
    if (mysqli_num_rows($query) > 0) {
        echo "
      <script>
      Swal.fire(
'Error!!!',
  'Sorry this Student Already Exist.',
  'error'
)
       
      </script>
      ";
        echo '<script>
                            window.setTimeout(function() {
                    window.location.href = "late.php";
                }, 2000);
                            </script>';
    } else {
        $insert = "INSERT INTO late_submit WHERE matric_no = '$matric'";
        $query = mysqli_query($mysqli, $insert);
        if ($query) {
            echo "
      <script>
      Swal.fire(
'Success!!!',
  'Hurray!!! You have Successfully Added a New Student.',
  'success'
)
       
      </script>
      ";
            echo '<script>
                            window.setTimeout(function() {
                    window.location.href = "late.php";
                }, 2000);
                            </script>';
        }
    }
}


?>
<div class="page-wrapper">


    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="index.html">Late Submission</a>
                </li>
            </ol>
        </nav>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- *************************************************************** -->
        <!-- Start First Cards -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <form action="late.php" method="post">
                        <label for="">Enter Student Matric Number</label>
                        <input type="text" class="form-control form-lg" name="matric_no" id="">
                        <button type="submit" name="submit" class="btn btn-success mt-4">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- *************************************************************** -->
        <!-- End First Cards -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Sales Charts Section -->
        <!-- *************************************************************** -->

    </div>

    <?php

    include 'footer.php';
    ?>