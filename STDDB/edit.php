<?php include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $conn->query("UPDATE students SET name='$name', email='$email', course='$course' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
<body>
<h2>Edit Student</h2>
<form method="POST">
    Name: <input type="text" name="name" value="<?= $row['name'] ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $row['email'] ?>" required><br><br>
    Course: <input type="text" name="course" value="<?= $row['course'] ?>" required><br><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
