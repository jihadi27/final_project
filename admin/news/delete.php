<?php 
    include'../../connect.php';

    session_start();

    $news_id = $_GET['id'];
    $cat_id = $_GET['catid'];

    $sql1 = "SELECT * FROM news
            WHERE news_id = {$news_id};";
    $result = mysqli_query($conn, $sql1) or die("Query Failed.");
    $row = mysqli_fetch_assoc($result);

    unlink("../upload/".$row['post_image']);


    $sql = "DELETE FROM news
            WHERE news_id = {$news_id};";

    $sql .= "UPDATE categories 
            SET post= post - 1 
            WHERE category_id = {$cat_id}";
    
    if(mysqli_multi_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Delete Data Failed!";
    }

    mysqli_close($conn);
?>