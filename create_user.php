<?php
include 'db_connect.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword']; // Corrected parameter name

    if ($password === $confirmpassword) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        echo "Hashed password: " . htmlspecialchars($hashed_password) . "<br>";  // Debugging statement

        $stmt = $conn->prepare("INSERT INTO users (name, email, phone_number, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone_number, $hashed_password);

        if ($stmt->execute()) {
            echo "User created successfully<br>";
            header("Location: login.html");
            exit();
        } else {
            echo "Error: " . htmlspecialchars($stmt->error) . "<br>";
        }

        $stmt->close();
    } else {
        echo "Passwords do not match.<br>";
    }
}

$conn->close();
?>
