<?php
// booking.php

// Include the database connection code
require "includes/database_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure that the required form data is present
    if (!isset($_POST['property_id']) || empty($_POST['property_id'])) {
        echo "Property ID is missing!";
        return;
    }

    // Sanitize the property_id before using it in the database query
    $property_id = filter_var($_POST['property_id'], FILTER_SANITIZE_NUMBER_INT);

    // Retrieve and sanitize other form data
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';

    // Insert the booking data into the database using a prepared statement
    $sql = "INSERT INTO bookings (property_id, name, email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $property_id, $name, $email);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Successful booking, set the success message in a session variable
        session_start();
        $_SESSION['booking_success'] = true;
        header("Location: property_detail.php?property_id=" . $property_id);
        exit;
    } else {
        // Failed to insert the booking data, handle the error accordingly
        echo "Something went wrong with the booking process.";
        // You can display an error message or redirect the user to an error page
        // header("Location: error_page.php");
        // exit;
    }
} else {
    // Error in the prepared statement
    echo "Error in the database query.";
    // You can display an error message or redirect the user to an error page
    // header("Location: error_page.php");
    // exit;
}
mysqli_stmt_close($stmt);


// Close the database connection
mysqli_close($conn);
?>
