<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Evaluation </title>
    <link rel="stylesheet" href="Evaluate.css">
</head>
<body>
<?php include 'header.php'; ?>
<h2>Staff Evaluation</h2>


<?php
$servername = "localhost";
$username = "root";         
$password = "";        
$dbname = "staff";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO Evaluate (staff_name, position, rating, comments) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $staff_name = $_POST['staff_name'];
    $position = $_POST['position'];
    $rating = $_POST['performanceRating'];
    $comments = $_POST['comments'];
    
    $stmt->bind_param("ssss", $staff_name, $position, $rating, $comments);
    
    if ($stmt->execute()) {
        echo "<p>New record created successfully</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

// Fetch evaluations
$sql = "SELECT * FROM Evaluate";
$result = $conn->query($sql);

// Display evaluations
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Staff Name</th><th>Position</th><th>Rating</th><th>Comments</th><th>Submission Date</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['staff_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['position']) . "</td>";
        echo "<td>" . htmlspecialchars($row['rating']) . "</td>";
        echo "<td>" . htmlspecialchars($row['comments']) . "</td>";
        echo "<td>" . htmlspecialchars($row['reg_date']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No evaluations found.</p>";
}

$conn->close();
?>
<script src="Evaluate.js"></script>
</body>
</html>