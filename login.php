<?php
// Start session
session_start();

// Include database connection
require_once 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to retrieve the user's hashed password
    $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $db_username, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        // Password is correct, log in the user
        $_SESSION["user_id"] = $user_id;
        $_SESSION["username"] = $db_username;
        header("Location: dashboard.php"); // Redirect to a dashboard page
    } else {
        echo "Incorrect username or password.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
