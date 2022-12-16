<?php
        $servername = "localhost";
        $database = "anynews";
        $username = "root";
        $password = "";

    $hostname = "http://localhost/anynews";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection Failed: ".mysqli_connect_error());
    }

    
?>
