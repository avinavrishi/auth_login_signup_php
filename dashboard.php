<?php
// Start the session to access session variables
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login.html"); // Redirect to the login page if not authenticated
    exit();
}

// Display a welcome message with the user's username
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <p>This is your protected dashboard page.</p>
    <a href="logout.php">Logout</a> <!-- Include a logout link to log out the user -->
</body>
</html>
