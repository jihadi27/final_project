<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Any News</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="manifest" href="/site.webmanifest">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <?php include "header.php"; ?>
  <!-- End Header -->

  <main id="main">

    <section class="single-post-content">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-12 post-content border custom-border d-flex" data-aos="fade-up">
            <?php
              include "connect.php";

              $news_id = $_GET['id'];

              $sql = "SELECT news.news_id, news.title, news.post_date, news.description, news.admin,
                        categories.category_name, admins.username, news.category, news.post_image
                      FROM news 
                      LEFT JOIN categories ON news.category = categories.category_id
                      LEFT JOIN admins ON news.admin = admins.admin_id
                      WHERE news.news_id = {$news_id}";
              
              $result = mysqli_query($conn,$sql) or die("Query Failed.");
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
              <div class="post-meta">
                <div class="pt-5"></div>
                <span>
                  <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?>
                    <i class="fa-duotone fa-user-secret"></i>
                  </a>
                </span> <span class="mx-1">&bullet;</span>
                <span>
                  <?php echo $row['post_date']; ?>
                </span> <span class="mx-1">&bullet;</span> 
                <span>
                  <a href='author.php?authid=<?php echo $row['admin']; ?>'><?php echo $row['username']; ?></a>
                </span>
              </div>
              <span>
                <h1 class="mb-5"><?php echo $row['title']; ?></h1>
              </span>
              <div class="text-center my-4">
                <img src="admin/upload/<?php echo $row['post_image']; ?>" 
                class="image-fluid rounded" height="300" width="500">
                <br><br>
              </div>
              <span>
                <p class="h6"><?php echo $row['description']; ?></p>
              </span>
              <div class="pb-5"></div>
            </div>
            <!-- End Single Post Content -->
              <?php 
                    }
                  }else {
                    echo "<h2>No Record Found.</h2>";
                  }
              ?>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include "footer.php"; ?>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>