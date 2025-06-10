<?php include "db.php"; ?>
<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title>Edit Student</title></head>
<body>
    <h2>Edit Student</h2>
    <form method="POST">
        Name: <input type="text" name="name" value="<?= $row['name'] ?>" required><br>
        Age: <input type="number" name="age" value="<?= $row['age'] ?>" required><br>
        Grade: <input type="text" name="grade" value="<?= $row['grade'] ?>" required><br>
        Contact: <input type="text" name="contact" value="<?= $row['contact'] ?>" required><br>
        <input type="submit" name="update" value="Update Student">
    </form>
    <a href="index.php">Back</a>

    <?php
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];
        $contact = $_POST['contact'];

        $sql = "UPDATE students SET name='$name', age=$age, grade='$grade', contact='$contact' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Student updated successfully.</p>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>