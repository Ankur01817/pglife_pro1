<?php
$db_hostname = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "pglife_project";

$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$college_name = $_POST['college_name'];
$gender = $_POST['gender'];

$conn= new mysqli($db_hostname, $db_username, $db_password, $db_name);
if($conn->connect_error){
    die('connection failed :'.$conn->connect_error);
}
else {
    $stmt= $conn->prepare("INSERT INTO users(full_name,phone,email,password,college_name,gender) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss",$_POST['full_name'],$_POST['phone'],$_POST['email'],$_POST['password'],$_POST['college_name'],$_POST['gender']
);
    $stmt->execute();
    echo "registration successful";
    $stmt->close();
    $conn->close();
}
print_r($_POST);
?>
