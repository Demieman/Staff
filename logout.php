<?php
session_start(); 
session_destroy();

// Display a logout message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="stylesheet" href="logout.css"> 
</head>
<body>

<div class="container">
    <h2>You have been logged out</h2>
    <p>Thank you for using our service. You can log in again anytime.</p>
    <a href="logon.php">Login Again</a>
</div>

</body>
</html>