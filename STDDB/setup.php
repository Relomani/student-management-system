<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";
$pass = "";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Create database
if ($conn->query("CREATE DATABASE IF NOT EXISTS student_db") === TRUE) {
    echo "✅ Database 'student_db' created or already exists.<br>";
} else {
    die("❌ Database creation failed: " . $conn->error);
}

// Use the new database
$conn->select_db("student_db");

// Create table
$sql = "
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    course VARCHAR(50) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "✅ Table 'students' created or already exists.<br>";
} else {
    die("❌ Table creation failed: " . $conn->error);
}

echo "<h2>✔️ Setup complete!</h2>";
echo "<a href='index.php'>Go to Student List</a>";
?>
