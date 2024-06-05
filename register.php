<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $default_photo = 'uploads/default.png'; // Default photo path

    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password) ||
        !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        echo "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check_username = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($check_username);

        if ($result->num_rows > 0) {
            echo "This username is already taken!";
        } else {
            $sql = "INSERT INTO users (username, password, email, photo) VALUES ('$username', '$hashed_password', '$email', '$default_photo')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style3.css">
</head>
<body>
  <div class="register-container">
    <form action="register.php" method="post" class="register-form">
      <h2>Register</h2>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="email" name="email" placeholder="Email" required>
      <button type="submit">Register</button>
      <p>Already have account?</p><a href='login.php'>Login</a> 
    </form>
  </div>
</body>
</html>
