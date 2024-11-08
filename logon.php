<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
    <script>
        function validateForm() {
            const username = document.forms["logonForm"]["username"].value;
            const password = document.forms["logonForm"]["password"].value;

            if (!username || !password) {
                alert("Both username and password must be filled out.");
                return false;
            }
            return true; 
        }
    </script>
</head>
<body>
    <h2>Login</h2>

    <form name="logonForm" action="logon.php" method="POST" onsubmit="return validateForm()">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost"; 
        $db_username = "root"; 
        $db_password = "";
        $dbname = "staff"; 
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT Password FROM reg WHERE Username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashed_password);
            $stmt->fetch();
            if (password_verify($password, $hashed_password)) {
                header("Location: header.php");
                exit();
            } else {
                echo "<div class='error'>Invalid username or password.</div>";
            }
        } else {
            echo "<div class='error'>Invalid username or password.</div>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <div class="register-link">
        <p>Don't have an account? <a href="insert_data.php">Register here</a></p>
    </div>
</body>
</html>