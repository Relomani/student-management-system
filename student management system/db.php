<?php
$host = "localhost";
$user = "root"; // Change if you have a different user
$pass = "";
$dbname = "student_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>