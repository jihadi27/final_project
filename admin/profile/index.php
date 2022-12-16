<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Profile</title>

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
    <div class="container-fluid">
        <?php include'nav-profile.php' ?>

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
                    <!-- <li>
                        <a href="../category/index.php" class="nav-link text-truncate">
                        <i class="fs-5 bi-tags-fill"></i><span class="ms-1 d-none d-sm-inline">Category</span> </a>
                    </li> -->
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
                            <li class="breadcrumb-item active" aria-current="page">List</li>
                        </ol>
                        </nav>

                        <h1 class="h3">Profile List</h1>
                        <p>List of Profiles in AnyNews</p>
                        <div class="card">
                            <div class="card-body">
                                <a href="create.php" class="btn btn-block btn-primary btn-sm mb-4">
                                    <i class="fa-solid fa-square-plus mx-1"></i> Add Profile
                                </a>
                                <div class="table-responsive">
                                    <?php 
                                        include'../../connect.php';
                                        $limit = 3;
                                        
                                        if(isset($_GET['page'])){
                                            $page = $_GET['page'];                                         
                                        }else{
                                            $page = 1;
                                        }
                                        $offset = ($page - 1) * $limit;

                                        $sql = "SELECT * FROM admins ORDER BY admin_id DESC LIMIT {$offset},{$limit}";
                                        $result = mysqli_query($conn, $sql) or die("Query Failed.");
                                    if (mysqli_num_rows($result) > 0) {
                                    ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Manipulate</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td class="id"><?php echo $row['admin_id']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['password']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td>
                                                        <?php
                                                            if ($row['role'] == 1) {
                                                                echo "Admin";
                                                            } else {
                                                                echo "Author";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href='read.php?id=<?php echo $row["admin_id"]; ?>' class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a>
                                                        <a href='update.php?id=<?php echo $row["admin_id"]; ?>' class="btn btn-sm btn-warning"><i class="fa-solid fa-edit"></i></a>
                                                        <a href='delete.php?id=<?php echo $row["admin_id"]; ?>' onclick="return confirm_delete()" 
                                                        class="btn btn-sm btn-danger"><i class="fa-solid fa-eraser"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php
                                    }

                                        $sql1 = "SELECT * FROM admins";
                                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                                        if(mysqli_num_rows($result1) > 0) {

                                        $total_record = mysqli_num_rows($result1);

                                        $total_page = ceil($total_record / $limit);

                                        echo '<ul class="pagination justify-content-center">';
                                        if($page > 1){
                                            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 1).'">Prev</a></li>';
                                        }
                                        for($i = 1; $i <= $total_page; $i++){
                                        if($i == $page){
                                            $active = "active";
                                        }else{
                                            $active = "";
                                        }
                                            echo '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if($total_page > $page){
                                            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 1).'">Next</a></li>';
                                        }
                                            echo '</ul>';
                                        }    
                                    ?>
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

    <!-- Delete Script Alert  -->
    <script type="text/javascript">
        function confirm_delete() {
            return confirm('Yakin Mau Hapus?')
        }
    </script>

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-6UofPqm0QupIL0kzS/UIzekR73/luZdC6i/kXDbWnLOJoqwklBK6519iUnShaYceJ0y4FaiPtX/hRnV/X/xlUQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="../../assets/vendor/font-awesome/js/all.min.js"></script>
</body>
</html>