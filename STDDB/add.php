<?php include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $conn->query("INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Student</title></head>
<body>
<h2>Add Student</h2>
<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Course: <input type="text" name="course" required><br><br>
    <input type="submit" value="Add">
</form>
</body>
</html>
