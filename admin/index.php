<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AnyNews</title>
    
    <!-- Favicons -->
    <link href="../assets/img/favicon.ico" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/font-awesome/css/all.min.css" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="../assets/css/login-admin.css" rel="stylesheet">
</head>
<body>
    <!-- PHP Session -->
    <?php
        session_start();
        
        if(isset($_POST['login-submit'])){
            include "../connect.php";
            
            $user = mysqli_real_escape_string($conn, $_POST['username']);
            $psw = mysqli_real_escape_string($conn, $_POST['password']);
        
            $sql = "SELECT admin_id, username, role FROM admins WHERE username='$user' AND password='$psw'";
            $result = mysqli_query($conn, $sql) or die("Query Failed.");
    
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['admin_id'] = $row['admin_id'];
                    $_SESSION['admin_role'] = $row['role'];
                    $_SESSION['status'] = "login";
                    header("Location: dashboard.php");
                }
            }else{
                $_SESSION['error'] = "Gagal login, silahkan cek kembali username dan password Anda!";
            }
        }
        
    ?>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <video width="600px" controls loop autoplay>
                        <source src="../assets/video/anynews.mp4">
                    </video>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <!-- Start Form -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="card-body cardbody-color p-lg-5">
                        <div>
                            <a href="../index.php">
                                <img id="logo" src="../assets/img/navbrand.png" style="width: 320px;">
                            </a>
                        </div>
                        <div>
                            <label for="fname"><strong>Username: </strong></label> 
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div>
                            <label for="lname"><strong>Password: </strong></label>
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div>
                            <p style="color:red; font-size: 12px;"><?php if(isset($_SESSION['error'])){echo($_SESSION['error']);} ?></p>
                            <input class="fw-bolder" type="submit" value="Login" name="login-submit">
                            <input class="fw-bolder" type="reset" value="Reset" name="reset">
                        </div>
                    </form>
                    <!-- End Form  -->
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5">
                <!-- Copyright -->
                <div class="text-white mb-3 mb-md-0">
                    Copyright &copy; <strong>AnyNews 2022.</strong> All rights reserved.
                </div>
                <!-- Copyright -->
    
                <!-- Right -->
                <div>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-white me-4">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#!" class="text-white">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <!-- Right -->
            </div>
        </footer>
    </section>

    <?php 
        unset($_SESSION['error']);
    ?>

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha512-6UofPqm0QupIL0kzS/UIzekR73/luZdC6i/kXDbWnLOJoqwklBK6519iUnShaYceJ0y4FaiPtX/hRnV/X/xlUQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/vendor/font-awesome/js/all.min.js"></script>
</body>
</html>