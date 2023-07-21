<?php
session_start();
require "includes/database_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("location: index.php");
    die();
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Something went wrong!";
    exit();
}

$user = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated profile information from the form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $college_name = $_POST['college_name'];

    // Perform data validation here if required

    // Update user information in the database
    $sql_update = "UPDATE users SET full_name = '$full_name', email = '$email', phone = '$phone', college_name = '$college_name' WHERE id = $user_id";

    if (mysqli_query($conn, $sql_update)) {
        // Profile updated successfully, redirect to the dashboard page
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile | PG Life</title>

    <?php include "includes/head_links.php"; ?>
    <!-- Add any additional CSS styles if needed -->
</head>

<body>
    <?php include "includes/header.php"; ?>

    <div class="edit-profile-page page-container">
        <h1>Edit Profile</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?= $user['full_name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" value="<?= $user['phone'] ?>" required>
            </div>
            <div class="form-group">
                <label for="college_name">College Name</label>
                <input type="text" id="college_name" name="college_name" value="<?= $user['college_name'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <?php include "includes/footer.php"; ?>

    <!-- Add any additional scripts if needed -->
</body>

</html>
