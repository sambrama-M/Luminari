<?php
session_start();
require 'db_connect.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name_or_email = $_POST['name']; // Adjusted to match the form field name
    $password = $_POST['password'];

    echo "Input Email or Username: " . htmlspecialchars($name_or_email) . "<br>"; // Debugging
    echo "Input Password: " . htmlspecialchars($password) . "<br>"; // Debugging

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE name = ? OR email = ?");
    $stmt->bind_param("ss", $name_or_email, $name_or_email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    echo "Query Result Rows: " . $stmt->num_rows . "<br>"; // Debugging
    echo "Query ID: " . htmlspecialchars($id) . "<br>"; // Debugging
    echo "Query Name: " . htmlspecialchars($name) . "<br>"; // Debugging
    echo "Query Hashed Password: " . htmlspecialchars($hashed_password) . "<br>"; // Debugging

    // Verify the password
    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        // Redirect to the profile page or home page
        header("Location: index.html"); // Changed to the correct success page
        exit();
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
