<?php
include 'db.php';

$result = $conn->query("SELECT email FROM users");
$emails = [];
while ($row = $result->fetch_assoc()) {
    $emails[] = $row['email'];
}

foreach ($emails as $email) {
    echo "$email<br>";
}

// Also output to CMD
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    exec("echo Registered Users: " . implode(", ", $emails));
}
?>
