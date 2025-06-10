<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head><title>Add Student</title></head>
<body>
    <h2>Add New Student</h2>
    <form method="POST">
        Name: <input type="text" name="name" required><br>
        Age: <input type="number" name="age" required><br>
        Grade: <input type="text" name="grade" required><br>
        Contact: <input type="text" name="contact" required><br>
        <input type="submit" name="submit" value="Add Student">
    </form>
    <a href="index.php">Back</a>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];
        $contact = $_POST['contact'];

        $sql = "INSERT INTO students (name, age, grade, contact) VALUES ('$name', $age, '$grade', '$contact')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Student added successfully.</p>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    ?>
</body>
</html>