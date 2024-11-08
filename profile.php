<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: logout.php"); // Redirect to login page if not logged in
    exit();
}

// Sample user data (you would normally fetch this from a database)
$user_id = $_SESSION['user_id'];
$user_name = "John Doe"; // Replace with actual data retrieval
$user_email = "john.doe@example.com"; // Replace with actual data retrieval
$user_course = "Computer Science"; // Replace with actual data retrieval
$user_image = "uploads/default.jpg"; // Default image path

// Check if an image exists for the user
// You would typically check this in your database
if (file_exists($user_image)) {
    $user_image = "uploads/profile_$user_id.jpg"; // Dynamic path for user image
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>

<div class="container">
    <h2>User Profile</h2>
    <img src="<?php echo htmlspecialchars($user_image); ?>" alt="Profile Image" class="profile-image">
    <p><strong>Name:</strong> <?php echo htmlspecialchars($user_name); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
    <p><strong>Course:</strong> <?php echo htmlspecialchars($user_course); ?></p>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="profile_image">Upload Profile Image:</label>
        <input type="file" name="profile_image" id="profile_image" required>
        <button type="submit">Upload</button>
    </form>

    <a href="edit_profile.php">Edit Profile</a>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>