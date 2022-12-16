<?php
    include'../../connect.php';

    if(isset($_FILES['fileToUpload'])){
        $errors = array();

        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $file_ext = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
        $extensions = array("jpeg","jpg","png","ico");

        if(in_array($file_ext,$extensions) === false){
            $errors[] = "File extensions not allowed, Please choose a JPG, JPEG, PNG or ICO";
        }

        if($file_size > 4194304){
            $errors[] = "File size must be 4mb or lower";
        }

        if(empty($errors) == true){
            move_uploaded_file($file_tmp,"../upload/".$file_name);
        }else{
            print_r($errors);
            die();
        }
    }

    session_start();
    $title = mysqli_real_escape_string($conn, $_POST['post-title']);
    $desc = mysqli_real_escape_string($conn, $_POST['post-desc']);
    $category = mysqli_real_escape_string($conn, $_POST['post-category']);
    $date = date("d M, Y");
    $author = $_SESSION['admin_id'];

    $sql = "INSERT INTO news (news_id,title,description,post_date,category,admin,post_image)
            VALUES (NULL,'{$title}','{$desc}','{$date}','{$category}','{$author}','{$file_name}');";
    $sql .= "UPDATE categories SET post = post + 1 WHERE category_id = {$category}";

    if(mysqli_multi_query($conn, $sql)){
        header("Location: index.php");
    }else{
        echo "<div class='alert alert danger'>Query Failed.</div>";
    }
?>