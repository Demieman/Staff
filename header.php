<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Title</title>
    <style>
        body {
            background-image: url('photo/llg.jpg'); 
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat; 
            margin: 0; 
            height: 100vh; 
          
        }

        header {
            background: rgba(255, 255, 255, 0.8); 
            padding: 20px; 
        }

        nav ul {
            list-style-type: none; 
            padding: 0; /
        }
        nav ul li {
            display: inline; 
            margin-right: 15px; 
        }
        nav ul li a {
            text-decoration: none; 
            color: #333; 
        }
        nav ul li a:hover {
            color: #007BFF;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="login.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="view.php">View Page</a></li>
                <li><a href="student.php">Student Evaluation</a></li>
                <li><a href="studenList.php">student_List</a></li>
                <li><a href="view_grade.php">Grade</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>