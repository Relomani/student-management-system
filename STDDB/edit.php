<?php 
include 'db.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM students WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $course = trim($_POST['course']);
    $conn->query("UPDATE students SET name='$name', email='$email', course='$course' WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Student</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="register-container">
  <h2>Edit Student</h2>

  <form method="POST" action="">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" required />

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required />

    <label for="course">Course</label>
    <input type="text" id="course" name="course" value="<?= htmlspecialchars($row['course']) ?>" required />

    <input type="submit" value="Update" />
  </form>

  <div class="button-group">
    <a href="index.php" class="button">Back to Student List</a>
  </div>
</div>

</body>
</html>
