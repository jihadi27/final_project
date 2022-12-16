<?php 
    include'../../connect.php';

    $admin_id = $_GET['id'];

    $sql = "DELETE FROM admins
            WHERE admin_id=$admin_id";
    
    if(mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Delete Data Failed!";
    }

    mysqli_close($conn);
?>