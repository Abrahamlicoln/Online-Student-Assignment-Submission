<?php
$title = "View Student Assignment | CMP 319 Assignment";
include 'header.php';
$active1 = "active";
$active2 = "";
include 'sidebar.php';

?>
<?php
if (isset($_POST['submit'])) {
    $matric = $_POST['matric'];
    $update = "UPDATE student_assignment SET status = '1' WHERE matric_no = '$matric'";
    $query = mysqli_query($mysqli, $update);
    if ($query) {
        echo "
        <script>
        window.location.href = 'viewstudent.php';
        </script>
        ";
    }
}

?>
<div class="page-wrapper">


    <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item">View Student Details
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Student Name</th>
                                        <th>Matric No</th>
                                        <th>Submission Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    date_default_timezone_set("Africa/Lagos");
                                    $select = "SELECT * FROM student_assignment";
                                    $query = mysqli_query($mysqli, $select);
                                    if (mysqli_num_rows($query) > 0) {
                                        $counter = 0;

                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $counter = $counter + 1;
                                            $fullname = $row['student_name'];
                                            $status = $row['status'];
                                            $matricno = $row['matric_no'];
                                            $date = $row['date_submitted'];
                                            $formattedDate = date('l, j F, Y \b\y g:ia', strtotime($date));
                                            $filename = $row['filename'];
                                    ?>
                                            <tr>
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $fullname; ?></td>
                                                <td><?php echo $matricno; ?></td>
                                                <td><?php echo $formattedDate; ?></td>
                                                <form action="viewstudent.php" method="post">
                                                    <input type="hidden" name="matric" value="<?php echo $matricno; ?>">
                                                    <td>

                                                        <?php
                                                        if ($status == 0) { ?>
                                                            <button class="btn btn-success p-2" type="submit" name="submit" onclick="downloadFile('../student_assignment/<?php echo $filename; ?>')">
                                                                Download
                                                            </button>

                                                        <?php

                                                        } else { ?>
                                                            <button class="btn btn-primary p-2" disabled>
                                                                Downloaded
                                                            </button>


                                                        <?php
                                                        }
                                                        ?>


                                                    </td>
                                                </form>
                                                <script>
                                                    function downloadFile(fileUrl) {
                                                        var link = document.createElement('a');
                                                        link.href = fileUrl;
                                                        link.download = fileUrl.substr(fileUrl.lastIndexOf('/') + 1);
                                                        document.body.appendChild(link);
                                                        link.click();
                                                        document.body.removeChild(link);
                                                    }
                                                </script>


                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>



                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>