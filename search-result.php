<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>AnyNews - Category</title>
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
    <section>
      <div class="main-container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-6 border">

            <!-- Post Container -->
            <div class="post-container">
              
              <?php 
                include "connect.php";
                
                if(isset($_GET['search'])) {
                  $search_term = mysqli_real_escape_string($conn, $_GET['search']);
              ?>

              <div class="section-header d-flex justify-content-center align-items-center mb-5">
                <h3 class="page-heading">Search: <?php echo $search_term; ?></h3>
              </div>

              <?php

                $limit = 3;
                                      
                if(isset($_GET['page'])){
                    $page = $_GET['page'];                                         
                }else{
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;

                $sql = "SELECT news.news_id, news.title, news.post_date, news.description, news.admin,
                          categories.category_name, admins.username, news.category, news.post_image
                        FROM news 
                        LEFT JOIN categories ON news.category = categories.category_id
                        LEFT JOIN admins ON news.admin = admins.admin_id
                        WHERE news.title LIKE '%{$search_term}%'
                        OR news.description LIKE '%{$search_term}%'
                        ORDER BY news.news_id 
                        DESC LIMIT {$offset},{$limit}";
                
                $result = mysqli_query($conn, $sql) or die("Query Failed.");
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) { 
              ?>

              <div class="post-entry-1 lg">
                <div class="text-center">
                  <a href="single-post.php?id=<?php echo $row['news_id']; ?>">
                    <img src="admin/upload/<?php echo $row['post_image']; ?>" class="img-fluid" width="600">
                  </a>
                </div>
                <div class="post-meta">
                  <span>
                    <i class="fa-solid fa-tags"></i>
                    <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                  </span> <span class="mx-1">&bullet;</span>
                  <span>
                    <i class="fa-solid fa-calendar"></i>
                    <?php echo $row['post_date']; ?>
                  </span> <span class="mx-1">&bullet;</span> 
                  <span>
                    <i class="fa-solid fa-user"></i>
                    <a href='author.php?search=<?php echo $row['admin']; ?>'><?php echo $row['username']; ?></a>
                  </span>
                </div>
                <h3>
                  <a href="single-post.php?id=<?php echo $row['news_id']; ?>"><?php echo $row['title']; ?></a>
                </h3>
                <p class="mb-4 d-block">
                  <?php echo substr($row['description'],0,200) . "..."; ?>
                </p>
              </div>
              <?php 
                    }
                  }else {
                    echo "<h2>No Record Found.</h2>";
                  }
              ?>
              <?php
                // Show Pagination

                $sql1 = "SELECT * FROM news 
                        WHERE news.title LIKE %{$search_term}%";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
                $row1 = mysqli_fetch_assoc($result1);


                if (mysqli_num_rows($result1) > 0) {

                  $total_record = mysqli_num_rows($result1);

                  $total_page = ceil($total_record / $limit);

                  echo '<ul class="pagination justify-content-center">';
                  if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="index.php?search=' . $search_term . '&page=' . ($page - 1) . '">Prev</a></li>';
                  }
                  for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                      $active = "active";
                    } else {
                      $active = "";
                    }
                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?search=' . $search_term . '&page=' . $i . '">' . $i . '</a></li>';
                  }
                  if ($total_page > $page) {
                    echo '<li class="page-item"><a class="page-link" href="index.php?search=' . $search_term . '&page=' . ($page + 1) . '">Next</a></li>';
                  }
                    echo '</ul>';
                  }
                }else{
                  echo "<h2>No Record Found.</h2>";
                }    
              ?>
            </div>
            <!-- End Container -->

          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

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