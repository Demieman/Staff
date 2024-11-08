<?php
session_start(); 
$validUsername = 'user123';
$validPassword = 'pass123'; 

$errorMessage = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = htmlspecialchars(trim($_POST['username']));
    $inputPassword = htmlspecialchars(trim($_POST['password']));
    if ($inputUsername === $validUsername && $inputPassword === $validPassword) {
        $_SESSION['user_id'] = $inputUsername; 
        
        // Redirect to Evaluate.php
        header("Location: evaluate.php");
        exit(); 
    } else {
        $errorMessage = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
        <div class="error"><?php echo $errorMessage; ?></div>
        <div class="register-link">Don't have an account? <a href="index.html">Register here</a></div>
    </form>
</div>

</body>
</html>