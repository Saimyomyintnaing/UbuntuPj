<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    if (strlen($password) < 8 || 
     !preg_match('/[A-Z]/', $password) ||
     !preg_match('/[a-z]/', $password) ||
     !preg_match('/[0-9]/', $password) ||
     !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
       echo "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

 if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

    $check_username = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_username);

    if ($result->num_rows > 0) {
        echo "This username is already taken!";
    } else {


    $sql = "UPDATE users SET username='$username',password='$hashed_password',email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
  }
 }
}
$conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Username and Password</title>
    <link rel="stylesheet" href="style4.css">

</head>
<body>
    <h2>Update Username and Password</h2>
    <form method="post" action="">
        New Username: <input type="text" name="username" required><br><br>
        New Password: <input type="password" name="password" required><br><br>
	New Email: <input type="email" name="email" required><br><br>
        <input type="submit" value="Update">
	<input type="button" value="Home" onclick="location.href='home.php'">

    </form>
</body>
</html>
