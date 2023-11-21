<?php
session_start();
$title = "Login | HOD Computer Science";
include 'header.php';
include('includes/dbconn.php');
if (isset($_POST['submit'])) {
    $email = filter_var(mysqli_real_escape_string($mysqli, $_POST['email_address']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(mysqli_real_escape_string($mysqli, $_POST['password']), FILTER_SANITIZE_STRING);
    $stmt = $mysqli->prepare("SELECT admin_email, admin_password, username FROM administrator WHERE admin_email=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($email, $hashed_password, $username);
    $rs = $stmt->fetch();
    $stmt->close();
    if ($rs) {
        if (md5($password) === $hashed_password) {
            $_SESSION['nice'] = "1";
            $_SESSION['username'] = $username;
            echo "<script>
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'success',
                title: 'You have logged in successfully'
                });
                
                setTimeout(function() {
                    window.location.href = 'administrator/index.php';
                }, 2000);
            </script>";
        } else {
            echo "<script>
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'error',
                title: 'Invalid username or password'
                });
                
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 2000);
            </script>";
        }
    }
}



?>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-2">
            <!-- Forgot Password -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-2">
                        <a href="index.php" class="app-brand-link gap-2"> <img src="assets/images/logo.png" alt="" height="37" width="40">
                            <p style="font-size:20px; color:#254929 !important; font-family: 'Poppins', sans-serif; font-weight:600;" class="app-brand-text demo text-body text-uppercase mt-3">CMP 319 ASSIGNMENT</p>
                        </a>
                    </div>
                    <p class="mb-1 mt-0">Administrator Login | HOD Computer Science</p>
                    <form id="formAuthentication" class="mb-3" action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="text" class="form-control" required name="email_address" placeholder="Please the Email Generated for you" autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Password</label>
                            <input type="text" class="form-control" required name="password" placeholder="Enter Password Generated for you" autofocus />
                        </div>
                        <button type="submit " name="submit" class="btn btn-primary d-grid w-100" style="background-color:#18A08B !important; border:none;">Login</button>
                    </form>

                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>
<!-- Core JS -->
<?php
include 'footer.php';
