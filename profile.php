<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Assuming you have user_id stored in the session
$user_id = $_SESSION['user_id'];
$profile_image = "uploads/default.png";

// Fetch user data from the database
$sql = "SELECT photo FROM users WHERE id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (!empty($row['photo'])) {
        $profile_image = "uploads/" . htmlspecialchars($row['photo']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .profile-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .profile-container img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }
        .profile-container a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #1877f2;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>User Profile</h2>
        <img src="<?php echo $profile_image; ?>" alt="Profile Picture">
        <p>Welcome to your profile, <?php echo $_SESSION['username']; ?>!</p>
        <a href="upload_form.php">Upload New Profile Picture</a>
        <a href="home.php">Go to homepage</a>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
