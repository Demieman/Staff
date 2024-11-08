<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registered Users</title>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #5cb85c;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h2>Registered Users</h2>
    <?php include 'header.php'; ?>

    <table>
        <tr>
            <th>Username</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Password (Hashed)</th>
        </tr>

        <?php
        // Database connection parameters
        $servername = "localhost"; // Database server
        $db_username = "root"; // Database username
        $db_password = ""; // Database password
        $dbname = "staff"; // Database name

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch records from the reg table
        $sql = "SELECT Username, Lname, Email,department, Password FROM reg";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Lname']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Password']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No registered users found.</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</body>
</html>