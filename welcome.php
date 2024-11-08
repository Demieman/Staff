<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Evaluation System</title>
    <link rel="stylesheet" href="welcome.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h1>Welcome to Habesha College</h1>
        <main>
            <p>We are committed to enhancing the quality of education through effective staff evaluations.</p>
            <p>Please fill out the form below to evaluate the staff member.</p>

            <form action="logon.php" method="POST"> <!-- Redirecting to insert_data.php -->
                <div class="form-group">
                    <label for="staff_name">Staff Name:</label>
                    <input type="text" id="staff_name" name="staff_name" required>
                </div>
                
                <button type="submit">Sign Up</button>
            </form>
        </main>

        <footer>
            <p>&copy; <?php echo date("Y"); ?> Habesha College Computer Science Students. All rights reserved.</p>
            <p>
                <a href="privacy.php">Privacy Policy</a> | 
                <a href="terms.php">Terms of Service</a>
            </p>
        </footer>
    </div>
</body>
</html>