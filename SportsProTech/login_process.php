<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require_once __DIR__ . '/data/db.php';
// Handle form login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if user exists
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['admin'] = true;
        $_SESSION['username'] = $username;

        header("Location: /SportsProTech/admin/dashboard.php");
        exit;
    } else {
        // Login failed
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: index.php"); // back to login page
        exit;
    }
}
?>
