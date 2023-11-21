<!-- Sidebar navigation-->
<?php
$username = $_SESSION['username'];
include '../includes/dbconn.php';

?>
<nav class="sidebar-nav">

    <ul id="sidebarnav">

        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="dashboard.php" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>

        <li class="list-divider"></li>

        <li class="nav-small-cap"><span class="hide-menu">MENU</span></li>
        <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="book-hostel.php" aria-expanded="false">
                <i class="fas fa-h-square"></i>
                <span class="hide-menu">View All Student</span>
            </a>
        </li>

    </ul>
</nav>

<!-- End Sidebar navigation -->