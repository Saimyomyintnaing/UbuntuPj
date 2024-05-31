<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["photo"]["size"] > 500000) { // 500KB
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Insert data into database
            $sql = "INSERT INTO profile (photo) VALUES ('$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Upload</title>
</head>
<body>
    <h2>Upload Profile Photo</h2>
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <label for="photo">Profile Photo:</label>
        <input type="file" name="photo" id="photo" required><br>
        <input type="submit" name="upload" value="Upload">
    </form>
<div>
    <h2>User Profile</h2>
    <?php 
	$profile_image="uploads/default.png";
	if (isset($_GET['img'])){
 	$profile_image ="uploads/". htmlspecialchars($_GET['img']);
}
?>
  	<img src="<?php echo $profile_image; ?>" alt='Profile Picture' width='100' height='100'>;

</div>
</body>
</html>


