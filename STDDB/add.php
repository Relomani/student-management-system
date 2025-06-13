<?php include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);
    $conn->query("INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add Student</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="register-container">
  <h2>Add Student</h2>

  <form method="POST" action="">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required placeholder="Student Name" />

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required placeholder="student@example.com" />

    <label for="course">Course</label>
    <input type="text" id="course" name="course" required placeholder="Course Name" />

    <input type="submit" value="Add Student" />
  </form>

  <div class="button-group">
    <a href="index.php" class="button">Back to Student List</a>
  </div>
</div>

</body>
</html>
