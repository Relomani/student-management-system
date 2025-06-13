<?php
include 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Optional: Check if the email exists in the users table
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        $message = "<p class='error'>Email not found.</p>";
    } else {
        $token = bin2hex(random_bytes(16));
        $expires_at = date("Y-m-d H:i:s", time() + 3600); // 1 hour

        // Remove old tokens
        $delStmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
        $delStmt->bind_param("s", $email);
        $delStmt->execute();
        $delStmt->close();

        // Insert new token
        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expires_at);
        $stmt->execute();
        $stmt->close();

        // Display the reset link (simulate email)
        $resetLink = "http://localhost/STDDB/reset_password.php?token=$token";
        $message = "<p class='success'>Reset link: <a href='" . htmlspecialchars($resetLink) . "'>$resetLink</a></p>";
    }

    $check->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="register-container">
    <h2>Forgot Password</h2>

    <?= $message ?>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <input type="submit" value="Send Reset Link">
    </form>

    <div class="button-group">
        <a href="login.php" class="button">Back to Login</a>
    </div>
</div>
</body>
</html>
