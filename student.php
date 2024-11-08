<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Student</title>
    <link rel="stylesheet" href="student.css"> <!-- Optional CSS -->
    <script>
        function calculateGrade() {
            const score = parseFloat(document.querySelector('input[name="score"]').value);
            let grade = "";
            if (score >= 90) {
                grade = "A";
            } else if (score >= 80) {
                grade = "B";
            } else if (score >= 70) {
                grade = "C";
            } else if (score >= 60) {
                grade = "D";
            } else {
                grade = "F";
            }

            document.getElementById("grade").value = grade; // Set the grade in the select box
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Insert Student Record</h2>
    <form action="" method="post" onsubmit="calculateGrade()">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="number" name="score" placeholder="Score" step="0.01" required oninput="calculateGrade()">
        
        <label for="grade">Grade</label>
        <select id="grade" name="grade" required>
            <option value="">Select Grade</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="F">F</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, email, course, score, grade) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $course, $score, $grade);

        // Set parameters and execute
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $course = $_POST['course'];
        $score = $_POST['score'];
        $grade = $_POST['grade'];

        if ($stmt->execute()) {
            echo "<p>New student record inserted successfully!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>