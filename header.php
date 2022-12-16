<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/navbrand.png" alt="logo" style="width: 100px; height: 50px;">
      </a>
      <!-- Navbar -->
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li class="dropdown"><a href=""><span>Categories</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <?php 
                include "connect.php";

                if(isset($_GET['cid'])) {
                  $cat_id = $_GET['cid'];
                }

                $sql = "SELECT * FROM categories
                        WHERE post > 0";
                
                $result = mysqli_query($conn,$sql) or die("Query Failed. : Category");
                if (mysqli_num_rows($result) > 0) { 
                    $active = "";
            
            ?>
            <ul>
            <!-- <li><a href='<?php echo '$hostname'; ?>'>Home</a></li> -->
              <?php while ($row = mysqli_fetch_assoc($result)) {

                if(isset($_GET['cid'])) {
                    if($row['category_id'] == $cat_id){
                        $active = "active";
                    }else{
                        $active = "";
                    }
                }

                echo "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
              } ?>
            </ul>
            <?php } ?>
          </li>

          <li><a href="about.php">About</a></li>
        </ul>
      </nav>
      <!-- End Navbar -->

      <div class="position-relative">
        <!-- Login -->
        <a href="admin/index.php" class="mx-2 btn btn-outline btn-sm" role="button">Login<span class="bi-box-arrow-in-right"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.php" class="search-form" method="get">
            <a href="search-result.php?search=<?php echo $search_term; ?>" type="button"><span class="icon bi-search"></span></a>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div>
        <!-- <div class="search-box-container">
          <h4>Search</h4>
          <form class="search-news" action="search-result.php" method="GET"></form>
        </div> -->
        <!-- End Search Form -->

      </div>

    </div>
</header>