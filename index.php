<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form id="registrationForm" action="index.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
        <input type="submit" value="Register">
        <div class="login-link">Already have an account? <a href="login.html">Login here</a></div>
        <div class="error"><?php echo isset($errorMessage) ? htmlspecialchars($errorMessage) : ''; ?></div>
    </form>
</div>

<?php
$host = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbname = "staff"; 
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMessage = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // Check for empty fields
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errorMessage = "All fields are required.";
    } elseif ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } else {
        // Check if username or email already exists
        $checkUser = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $checkUser->bind_param("ss", $username, $email);
        $checkUser->execute();
        $result = $checkUser->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = "Username or email already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            if ($stmt->execute()) {
                echo "<p>New user registered successfully</p>";
            } else {
                $errorMessage = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $checkUser->close();
    }
}
$conn->close();
?>
<script src="index.js"></script>

</body>
</html>