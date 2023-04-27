<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the input fields from the form
  $username = $_POST['username'] ?? null;
  $password = $_POST['password'] ?? null;

  // Validate the input fields
  if (!$username || !$password) {
    die('Username and password are required.');
  }

  // Load the existing users from the JSON file
  $users = json_decode(file_get_contents('users.json'), true);

  // Check if the username already exists
  if (isset($users[$username])) {
    die('Username already exists.');
  }

  // Hash the password and add the new user to the array
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $users[$username] = $hash;

  // Save the updated users to the JSON file
  file_put_contents('users.json', json_encode($users));

  // Redirect the user to the login page
  header('Location: login.php');
  exit();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
</head>
<body>
  <h1>Add User</h1>
  <form method="post">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>
    <label>Password:</label><br>
    <input type="password" name="password"><br><br>
    <input type="submit" value="Add User">
  </form>
</body>
</html>
