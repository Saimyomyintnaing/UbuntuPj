<?php 

session_start(); // Continue the session

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

$id = null;
$photo = null;

	if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the record
    $sql = "DELETE FROM users WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

	$sql = "SELECT id, username, email, photo FROM users";
	$result = $conn->query($sql)

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h2>User Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        <?php
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                $imagePath = "uploads/" . $row["photo"];
                
                echo "<td><img src='" . $imagePath . "' alt='photo' width='100' height='100'></td>";
                echo "<td><a href='update.php?id=" . $row["id"] . "'>Edit</a> | <a href='?action=delete&id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    

</body>
<button><a href="login.php">Logout</a></button>
<button><a href="profile.php">Profile</a></button>
</html>

<?php
// Close the database connection
$conn->close();
?>

