<?php
session_start();
$title = "Assignment Submission";
include 'header.php';
include('includes/dbconn.php');
if (isset($_POST['submit'])) {
  $fullname = filter_var(mysqli_real_escape_string($mysqli, $_POST['fullname']), FILTER_SANITIZE_STRING);
  $matric_no = filter_var(mysqli_real_escape_string($mysqli, $_POST['matricno']), FILTER_SANITIZE_STRING);
  $new_fullname = $fullname;
  // Replace spaces with underscores in the fullname
  $new_fullname = str_replace(' ', '_', $new_fullname);
  // Generating the filename
  $filename = $new_fullname . '_' . $matric_no . '.pdf';
  // Moving the uploaded file to the student_assignment folder
  $destination = 'student_assignment/' . $filename;

  // Check if the matric_no exists in late_submit table
  $select_late_submit = "SELECT * FROM late_submit WHERE matric_no = '$matric_no'";
  $query_late_submit = mysqli_query($mysqli, $select_late_submit);

  // Check if the matric_no exists in student_assignment table
  $select_student_assignment = "SELECT * FROM student_assignment WHERE matric_no = '$matric_no'";
  $query_student_assignment = mysqli_query($mysqli, $select_student_assignment);

  if (mysqli_num_rows($query_late_submit) > 0) {
    // Matric_no found in late_submit table
    if (mysqli_num_rows($query_student_assignment) > 0) {
      // Matric_no found in student_assignment table
      echo "
        <script>
          Swal.fire(
            'Information!!!',
            'Sorry, you have already uploaded your project.',
            'info'
          );
          window.setTimeout(function() {
            window.location.href = 'index.php';
          }, 2000);
        </script>
      ";
    } else {
      // Matric_no not found in student_assignment table
      date_default_timezone_set("Africa/Lagos");
      // Insert the student information into student_assignment table
      $insert = "INSERT INTO student_assignment (student_name, matric_no, filename, status, date_submitted) VALUES ('$fullname', '$matric_no', '$filename', '0', NOW())";
      $query = mysqli_query($mysqli, $insert);

      if ($query) {
        echo "
          <script>
            Swal.fire(
              'Upload Success!!!',
              'Your Project has been Uploaded Successfully.',
              'success'
            );
            window.setTimeout(function() {
              window.location.href = 'index.php';
            }, 2000);
          </script>
        ";
      } else {
        echo "
          <script>
            Swal.fire(
              'Error!!!',
              'We are unable to upload your project at the moment. Please try again later.',
              'error'
            );
            window.setTimeout(function() {
              window.location.href = 'index.php';
            }, 2000);
          </script>
        ";
      }
    }
  } else {
    // Matric_no not found in late_submit table
    if (mysqli_num_rows($query_student_assignment) > 0) {
      // Matric_no found in student_assignment table
      echo "
        <script>
          Swal.fire(
            'Information!!!',
            'Sorry, you have already uploaded your project.',
            'info'
          );
          window.setTimeout(function() {
            window.location.href = 'index.php';
          }, 2000);
        </script>
      ";
    } else {
      // Matric_no not found in both late_submit and student_assignment tables
      echo "
        <script>
          Swal.fire(
            'Alert!!!',
            'You have not paid for the subscription.',
            'warning'
          );
          window.setTimeout(function() {
            window.location.href = 'index.php';
          }, 2000);
        </script>
      ";
    }
  }
}



?>

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-2">
      <!-- Forgot Password -->
      <div class="card">
        <div class="app-brand justify-content-center mt-3 mb-2">
          <a href="index.php" class="app-brand-link gap-2"> <img src="assets/images/logo.png" alt="" height="37" width="40">
            <p style="font-size:20px; color:#254929 !important; font-family: 'Poppins', sans-serif; font-weight:600;" class="app-brand-text demo text-body text-uppercase mt-3">CMP 319 ASSIGNMENT</p>
          </a>
        </div>
        <?php
        $select = "SELECT `date` FROM `date_submission` WHERE `id` = '1'";
        $query = mysqli_query($mysqli, $select);
        if (mysqli_num_rows($query) > 0) {
          while ($row = mysqli_fetch_assoc($query)) {
            $new_date = date("Y-m-d H:i:s");
            $close_date = $row['date'];

            if ($new_date >= $close_date) {
        ?>
              <div class="container">
                <h5 class="text-secondary" style="line-height:30px;">Sorry, Project Submission has been Closed. Thank You</h5>
              </div>
            <?php
            } else {
            ?>
              <div class="mt-2">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col py-2 mx-1 my-2" style="background-color:#18A08B; border-radius:10px !important;">
                      <center><span class="number text-white fw-bold" style="font-size:25px;" id="days"></span><br><span class="text text-white fw-bold">Day(s)</span></center>
                    </div>
                    <div class="col py-2 rounded mx-1 my-2" style="background-color:#18A08B;">
                      <center><span class="number text-white fw-bold" style="font-size:25px;" id="hours"></span><br><span class="text text-white fw-bold">Hour(s)</span></center>
                    </div>
                    <div class="col py-2 rounded mx-1 my-2" style="background-color:#18A08B;">
                      <center><span class="number text-white fw-bold" style="font-size:25px;" id="minutes"></span><br><span class="text text-white fw-bold">Minute(s)</span></center>
                    </div>
                    <div class="col py-2 rounded mx-1 my-2" style="background-color:#18A08B;">
                      <center><span class="number text-white fw-bold" style="font-size:25px;" id="seconds"></span><br><span class="text text-white fw-bold">Second(s)</span></center>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <!-- Logo -->
                <p class="mb-1 mt-0">Enter your Fullname and Matric as it was on your School Portal..</p>
                <form id="formAuthentication" class="mb-3" action="index.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="fullname" class="form-label">Fullname</label>
                    <input type="text" class="form-control" required name="fullname" placeholder="Ex: Joseph Abraham Dangana" autofocus />
                  </div>
                  <div class="mb-3">
                    <label for="matricno" class="form-label">Matric Number</label>
                    <input type="text" class="form-control" required name="matricno" placeholder="Ex: 0219047000654" autofocus />
                  </div>
                  <div class="mb-3">
                    <label for="file" class="form-label">Upload your Project Here (<i>Only PDF File is Allowed</i>)</label>
                    <input class="form-control" name="file" type="file" accept=".pdf" id="formFile">
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary d-grid w-100" style="background-color:#18A08B !important; border:none;">Submit Project</button>
                </form>
              </div>
        <?php
            }
          }
        }
        ?>









        <?php
        include 'footer.php';
