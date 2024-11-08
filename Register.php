<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="index.css"> <!-- Optional: Your CSS file -->
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>

        <input type="submit" value="Register">
        <div class="login-link">Already have an account? <a href="login.PHP">Login here</a></div>
        <div class="error" id="errorMessage"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></div>
    </form>
</div>

<?php
$host = 'localhost'; 
$dbname = 'staff'; // the name of your database
$username = 'root'; // your database username
$password = ''; // your database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMessage = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = htmlspecialchars(trim($_POST['password']));
    $confirmPass = htmlspecialchars(trim($_POST['confirmPassword']));

    if (empty($user) || empty($email) || empty($pass) || empty($confirmPass)) {
        $errorMessage = "All fields are required.";
    } elseif ($pass !== $confirmPass) {
        $errorMessage = "Passwords do not match.";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT * FROM register WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $user, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = "Username or email already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
            // Insert new user into the database
            $insertStmt = $conn->prepare("INSERT INTO register (username, email, password) VALUES (?, ?, ?)");
            $insertStmt->bind_param("sss", $user, $email, $hashedPassword);
            if ($insertStmt->execute()) {
                echo "<p>Registration successful!</p>";
                exit;
            } else {
                $errorMessage = "Error: " . $insertStmt->error;
            }
            $insertStmt->close();
        }
        $stmt->close();
    }
}
$conn->close();
?>
<script src="index.js"></script> <!-- Optional: Your JavaScript file -->
</body>
</html>