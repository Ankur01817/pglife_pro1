<?php
session_start();

if(isset($_SESSION['user_id'])){
    $user_name=$_SESSION['user_id'];
$name=$_SESSION['name'];
}
echo "Hello" . $name ;
?>