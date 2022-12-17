<!-- Recent Post -->
<div id="sidebar" class="col-lg-3 border custom-border">
    <div class="section-header d-flex justify-content-center mb-5 pt-4">
        <h3>Recent Post</h3>
    </div>
    <?php
        include "connect.php";

        $limit = 5;          

        $sql = "SELECT news.news_id, news.title, news.post_date,
                categories.category_name, news.category, news.post_image
                FROM news 
                LEFT JOIN categories ON news.category = categories.category_id
                ORDER BY news.news_id 
                DESC LIMIT {$limit}";
        
        $result = mysqli_query($conn,$sql) or die("Query Failed : Recent Post");
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>

    <div class="post-entry-1 section-header">
        <div class="text-center">
            <a href="single-post.php?id=<?php echo $row['news_id']; ?>">
            <img src="admin/upload/<?php echo $row['post_image']; ?>" class="img-fluid" width="600" height="300">
            </a>
        </div>
        <div class="post-meta">
            <span class="h6 d-grid gap-5">
                <a href="single-post.php?id=<?php echo $row['news_id']; ?>"><?php echo $row['title']; ?></a>
            </span></span>
            <span>
                <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
            </span> <span class="mx-1">&bullet;</span>
            <span>
                <a><?php echo $row['post_date']; ?></a>
            </span><br><br>
            <a href="single-post.php?id=<?php echo $row['news_id']; ?>">Read More</a>
        </div>
    </div>
    <?php 
            }
        }else{
            echo "<h2>No Recent Post Found.</h2>";
        }
    ?>
    </div>
    <div class="pb-4"></div>
</div>
<!-- End Recent Post -->