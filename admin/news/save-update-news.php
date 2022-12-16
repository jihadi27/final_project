<?php 
include "../../connect.php";

if(empty($_FILES['new-img']['name'])){
    $file_name = $_POST['old-img'];
}else{
    $errors = array();

    $file_name = $_FILES['new-img']['name'];
    $file_size = $_FILES['new-img']['size'];
    $file_tmp = $_FILES['new-img']['tmp_name'];
    $file_type = $_FILES['new-img']['type'];
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

$sql = "UPDATE news SET title='{$_POST["news-title"]}', description='{$_POST["news-desc"]}', post_date='{$_POST["news-date"]}', 
            category={$_POST["news-category"]}, post_image='{$file_name}'
            WHERE news_id={$_POST["news-id"]}";

$result = mysqli_query($conn, $sql);
if($result){
    header("Location: index.php");
}else{
    echo "Query Failed.";
}

?>