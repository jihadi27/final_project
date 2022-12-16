<!-- Nav   -->
<?php
    session_start();
    if(isset($_SESSION['status']) != "login"){
        header("Location: {$hostname}/admin");
    }

    if($_SESSION['admin_role'] == '0'){
        header("Location: index.php");
    }

    if(isset($_POST['logout-submit'])) {
        session_destroy();
        header("Location: {$hostname}/admin");
    }
?>

<nav class="navbar navbar-light p-3">
    <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
        <a class="navbar-brand" href="../dashboard.php">
            <img id="logo" src="../../assets/img/navbrand.png" style="width: 120px; height: 50px;">
        </a>
        <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="col-12 col-md-4 col-lg-2">
        <input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search">
    </div>
    <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
        <div class="dropdown">
            <a class="btn btn-secondary-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Welcome, <?php echo($_SESSION['username']) ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li>
                    <form id="logout_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <button class="dropdown-item" type="submit" name="logout-submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
    unset($_SESSION['error']);
?>
<!-- End Nav  -->