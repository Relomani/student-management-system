<?php
include 'db.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>TKU Student Database</h2>
    <p>Welcome, <?= $_SESSION['user']; ?> | <a href="logout.php">Logout</a></p>
    <a class="button" href="add.php">Add New Student</a>
    <br><br>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['course']}</td>
                <td>
                    <a class='button' href='edit.php?id={$row['id']}'>Edit</a>
                    <a class='button' href='delete.php?id={$row['id']}' onclick=\"return confirm('Delete this student?')\">Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
