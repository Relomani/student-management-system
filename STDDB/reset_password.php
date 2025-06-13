<?php
include 'db.php';
$message = "";
$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT email FROM password_resets WHERE token=? AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($email);
    if ($stmt->fetch()) {
        $stmt->close();

        $update = $conn->prepare("UPDATE users SET password=? WHERE email=?");
        $update->bind_param("ss", $new_password, $email);
        $update->execute();
        $update->close();

        $conn->query("DELETE FROM password_resets WHERE token='$token'");
        $message = "<p class='success'>Password updated successfully. <a href='login.php'>Login here</a></p>";
    } else {
        $message = "<p class='error'>Invalid or expired reset link.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="register-container">
    <h2>Reset Password</h2>
    <?php echo $message; ?>
    <?php if (empty($message)): ?>
    <form method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label>New Password:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Reset Password">
    </form>
    <?php endif; ?>
</div>
</body>
</html>
