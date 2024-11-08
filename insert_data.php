<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
    <script>
        function validateForm() {
            const username = document.forms["registerForm"]["username"].value;
            const lname = document.forms["registerForm"]["lname"].value;
            const email = document.forms["registerForm"]["email"].value;
            const department = document.forms["registerForm"]["department"].value;
            const password = document.forms["registerForm"]["password"].value;

            if (!username || !lname || !email || !department || !password) {
                alert("All fields must be filled out.");
                return false;
            }

            // Simple email format validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true; // Form is valid
        }
    </script>
</head>
<body>
    <h2>Register</h2>

    <form name="registerForm" action="insert_data.php" method="POST" onsubmit="return validateForm()">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="text" name="lname" placeholder="Enter Last Name" required>
        <input type="email" name="email" placeholder="Enter Email" required>
        
        <select id="department" name="department" required>
            <option value="">Select Department</option>
            <optgroup label="Degree Programs">
                <option value="computer">Computer Science</option>
                <option value="management">Management</option>
                <option value="accounting_and_finance">Accounting and Finance</option>
            </optgroup>
            <optgroup label="Diploma Programs">
                <option value="nursing">Nursing</option>
                <option value="crop_production">Crop Production</option>
                <option value="administration">Administration</option>
                <option value="pharmacy">Pharmacy</option>
                <option value="budget_service">Budget Service</option>
            </optgroup>
        </select>
        
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Register</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost"; 
        $db_username = "root"; 
        $db_password = "";
        $dbname = "staff"; 

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get data from the form
        $username = $_POST['username'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO reg (Username, Lname, Email, Department, Password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $lname, $email, $department, $password);
        
        if ($stmt->execute()) {
            header("Location: header.php");
            exit(); // Ensure no further code is executed after redirect
        } else {
            echo "<div class='error'>Error: " . $stmt->error . "</div>";
        }
        $stmt->close();
        $conn->close();
    }
    ?>

    <div class="login-link">
        <p>Already have an account? <a href="logon.php">Logon here</a></p>
    </div>
</body>
</html>