<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Profile</title>

    <!-- Favicons -->
    <link href="../../assets/img/favicon.ico" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/font-awesome/css/all.min.css" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="../../assets/css/dashboard.css" rel="stylesheet">
</head>
<body>
    <!-- PHP Session -->
    <?php
        include '../../connect.php';

        $sql = "SELECT * FROM admins";
        $datas = $conn->query($sql);

        $admin_id = $_GET['id'];
        $sql = "SELECT * FROM admins 
                WHERE admin_id=$admin_id";
        $datas = $conn->query($sql);

        while ($data = mysqli_fetch_array($datas)){
            $user = $data['username'];
            $psw = $data['password'];
            $name = $data['name'];
        }
    ?>

    <div class="container-fluid">
        <!-- Nav   -->
        <?php include'nav-profile.php' ?>
        <!-- End Nav  -->

        <!-- Sidebar -->
        <div class="offcanvas offcanvas-size-sm offcanvas-start w-25" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
            <div class="offcanvas-header">
                <h6 class="offcanvas-title d-none d-sm-block" id="offcanvas">Menu</h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body px-0">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
                    <li>
                        <a href="../dashboard.php" class="nav-link text-truncate">
                        <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                    </li>
                    <li>
                        <a href="../profile/index.php" class="nav-link text-truncate">
                        <i class="fs-5 bi-people-fill"></i><span class="ms-1 d-none d-sm-inline">Profile</span></a>
                    </li>
                    <li>
                        <a href="../news/index.php" class="nav-link text-truncate">
                        <i class="fs-5 bi-newspaper"></i><span class="ms-1 d-none d-sm-inline">News</span></a>
                    </li>
                    <li>
                        <a href="../category/index.php" class="nav-link text-truncate">
                        <i class="fs-5 bi-tags-fill"></i><span class="ms-1 d-none d-sm-inline">Category</span> </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col min-vh-100 p-4">
                    <!-- toggler -->
                    <button class="btn float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
                        <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"></i>
                    </button>
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Profile</a></li>
                                <li class="breadcrumb-item active" aria-current="page">See Profile</li>
                            </ol>
                        </nav>
                        <h1 class="h2">See Profile</h1>
                        <p>To See A New Profile, Please Fill In The Form Below!</p>

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="admin_id" class="form-label">Admin ID</label>
                                    <input type="text" class="form-control" name="admin_id" id="admin_id" placeholder="Admin ID" required
                                    value="<?php echo $admin_id ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required
                                    value="<?php echo $user ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password" required
                                    value="<?php echo $psw ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required
                                    value="<?php echo $name ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <!-- End Sidebar -->
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright &copy; <strong>AnyNews 2022.</strong> All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
                <a href="#" class="text-white me-4">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="#" class="text-white me-4">
                    <i class="fa-brands fa-google"></i>
                </a>
                <a href="#" class="text-white">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </div>
            <!-- Right -->
        </div>
    </footer>
    <!-- End Footer -->

    <?php
        unset($_SESSION['error']);
    ?>

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-6UofPqm0QupIL0kzS/UIzekR73/luZdC6i/kXDbWnLOJoqwklBK6519iUnShaYceJ0y4FaiPtX/hRnV/X/xlUQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../assets/vendor/font-awesome/js/all.min.js"></script>
</body>
</html>