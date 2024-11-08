<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Evaluation Form</title>
    <link rel="stylesheet" href="Evaluate.css">
</head>
<body>
<?php include 'header.php'; ?>
<fieldset>
<legend><h2>Staff Evaluation Form</h2></legend>
<form action="" method="post">
    <input type="text" name="staff_name" placeholder="Staff Name" required>
    <input type="text" name="position" placeholder="Position" required>
    <label for="performanceRating">Performance Rating</label>
    <select id="performanceRating" name="performanceRating" required>
        <option value="">Select a rating</option>
        <option value="excellent">Excellent</option>
        <option value="good">Good</option>
        <option value="average">Average</option>
        <option value="poor">Poor</option>
    </select>
    <textarea name="comments" placeholder="Comments" required></textarea>
    <button type="submit">Submit Evaluation</button>
</form>
<?php
$servername = "localhost";
$username = "root";         
$password = "";        
$dbname = "staff";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
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
$sql = "SELECT * FROM Evaluate";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
     "<table>";
     "<tr><th>ID</th><th>Staff Name</th><th>Position</th><th>Rating</th><th>Comments</th><th>Submission Date</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        "<tr>";
         "<td>" . htmlspecialchars($row['id']) . "</td>";
        "<td>" . htmlspecialchars($row['staff_name']) . "</td>";
         "<td>" . htmlspecialchars($row['position']) . "</td>";
         "<td>" . htmlspecialchars($row['rating']) . "</td>";
        "<td>" . htmlspecialchars($row['comments']) . "</td>";
         "<td>" . htmlspecialchars($row['reg_date']) . "</td>";
         "</tr>";
    }
     "</table>";
} else {
    echo "<p>No evaluations found.</p>";
}
$conn->close();
?>
<script src="Evaluate.js"></script>
</fieldset>
</body>
</html>