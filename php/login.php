<?php

session_start();

// Check if the user is already logged in, redirect to dashboard
if (isset($_SESSION['user'])) {
  header('Location: dashboard.php');
  exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  // Load the existing users from the JSON file
  $users = json_decode(file_get_contents('users.json'), true);

  // Get the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the user exists
  if (isset($users[$username])) {
    // Verify the password
    if (password_verify($password, $users[$username]['password'])) {
      // Login successful, store user data in session and redirect to dashboard
      $_SESSION['user'] = array(
        'username' => $username,
        'name' => $users[$username]['name']
      );
      header('Location: dashboard.php');
      exit();
    } else {
      // Password incorrect
      $error = 'Incorrect password. Please try again.';
    }
  } else {
    // User not found
    $error = 'User not found. Please check your username and try again.';
  }

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
  <?php endif; ?>
  <form method="post">
    <p>
      <label for="username">Username:</label>
      <input type="text" name="username" required>
    </p>
    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
    </p>
    <p>
      <button type="submit">Login</button>
    </p>
  </form>
</body>
</html>