<?php include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Student List</h1>
    <a href="add.php">+ Add Student</a>
    <input type="text" id="searchInput" placeholder="Search by name..." onkeyup="searchTable()">

    <table border="1" id="studentTable">
        <tr>
            <th>Name</th><th>Age</th><th>Grade</th><th>Contact</th><th>Actions</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['age']}</td>
                <td>{$row['grade']}</td>
                <td>{$row['contact']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> | 
                    <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
        }
        ?>
    </table>
    <script src="script.js"></script>
</body>
</html>