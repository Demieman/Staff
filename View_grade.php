<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grade Report</title>
    <link rel="stylesheet" href="ViewGrade.css"> <!-- Link to your CSS -->
    <style>
        
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<h2>Grade Report</h2>

<?php
$servername = "localhost"; // Database server
$username = "root";        // Database username
$password = "";            // Database password
$dbname = "staff";         // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to UTF-8
$conn->set_charset("utf8");

// Fetch student records
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Course</th><th>Score</th><th>Grade</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['course']) . "</td>";
        echo "<td>" . htmlspecialchars($row['score']) . "</td>";
        echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No student records found.</p>";
}

// Close connection
$conn->close();
?>

<script src="student.js"></script>
</body>
</html>