<?php 
include 'db.php';

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

	$user_sql = "SELECT id, username, email FROM users";
	$result = $conn->query($user_sql)

        $profile_sql = "SELECT id, photo FROM profile";
        $result = $conn->query($profile_sql)

	
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
            <th>Action</th>
        </tr>
        <?php
        // Check if there are any rows returned
        if ($user_result->num_rows > 0) {
            // Output data of each row
            while($row = $user_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td><a href='update.php?id=" . $row["id"] . "'>Edit</a> | <a href='?action=delete&id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    <table>
	<tr>
	   <th>ID</th>
	   <th>photo</th>
	</tr>
	 <?php
        // Check if there are any rows returned
        if ($profile_result->num_rows > 0) {
            // Output data of each row
            while($row = $profile_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["photo"] . "</td>";
                echo "<td><img src='" . $row["photo"] . "' alt='Profile Photo' width='100' height='100'></td>";
 		echo "</tr>"
	}
        } else {
            echo "<tr><td colspan='2'>No users found</td></tr>";
        }
        ?>


</body>
<button><a href="login.php">Logout</a></button>
</html>

<?php
// Close the database connection
$conn->close();
?>

