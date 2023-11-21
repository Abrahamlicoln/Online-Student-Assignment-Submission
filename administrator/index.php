<?php
$title = "Dashboard | CMP 319 Assignment";
include 'header.php';
$active1 = "active";
$active2 = "";
include 'sidebar.php';

?>
<div class="page-wrapper">


    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-dark font-weight-medium mt-3 mb-1">
                    <?php
                    date_default_timezone_set("Africa/Lagos");
                    $time = date("H");

                    if ($time <= 12) {
                        echo "Good Morning, " . $username;
                    } elseif ($time <= 15) {
                        echo "Good Afternoon, " . $username;
                    } elseif ($time <= 24) {
                        echo "Good Evening, " . $username;
                    }

                    ?>


                </h3>
                <div class="d-flex align-items-center">

                </div>
            </div>

        </div>
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
            <div class="col-md-6">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">
                                            <?php
                                            $select = "SELECT * FROM student_assignment";
                                            $query = mysqli_query($mysqli, $select);
                                            if ($query) {
                                                $numRows = mysqli_num_rows($query);
                                                if ($numRows >= 1) {
                                                    echo $numRows;
                                                }
                                            }




                                            ?>

                                        </h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Number of Project Submitted</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">
                                            <form action="download.php" method="post">
                                                <button type="submit" class="btn btn-success p-2" name="download"><i class="fas fa-folder-open"></i> Download Folder</button>
                                            </form>
                                        </h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 mt-2 text-truncate">Automatically Download all Student Project</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="user-minus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

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