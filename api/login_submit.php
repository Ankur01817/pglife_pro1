<?php
session_start();
require("../includes/database_connect.php");

$email = $_POST['email'];
$password = $_POST['password'];
$password = sha1($password); // Note: Consider using a more secure hashing method.

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Something went wrong";
    exit;
}

$row_count = mysqli_num_rows($result); // Use a single equal sign for assignment.

if ($row_count == 0) {
    echo "Login failed! Invalid email or password.";
    exit;
}

$row = mysqli_fetch_assoc($result);
$_SESSION['user_id'] = $row['id'];
$_SESSION['full_name'] = $row['full_name'];
$_SESSION['email'] = $row['email'];

header("Location: ../dashboard.php");

mysqli_close($conn);
?>
