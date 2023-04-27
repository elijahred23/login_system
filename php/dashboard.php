<?php

session_start();

// Check if the user is logged in, redirect to login page
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}

// Get the user data from the session
$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
</head>
<body>
  <h1>Welcome, <?php echo $user['name']; ?>!</h1>
  <p>You are logged in as <?php echo $user['username']; ?>.</p>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>
