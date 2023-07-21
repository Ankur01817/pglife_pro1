<?php
    $conn=mysqli_connect("127.0.0.1","root","","pglife");
    if(mysqli_connect_errno()){
        echo "Failed to connect MYSQL! Please contact to admin.";
        return;
    }
?>