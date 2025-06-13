<?php
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "<p class='error'>Invalid email format.</p>";
    } elseif (empty($password)) {
        $message = "<p class='error'>Password cannot be empty.</p>";
    } else {
        // Check if email exists
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $message = "<p class='error'>Email already registered. Please <a href='login.php'>login</a>.</p>";
        } else {
            $checkStmt->close();

            // Hash password for DB
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashedPassword);

            if ($stmt->execute()) {
                // Save email and plain password to file (insecure, for demo only)
                file_put_contents("users.txt", "$email : $password\n", FILE_APPEND | LOCK_EX);

                // Print to terminal / command prompt
                error_log("Registered user: $email with password: $password");

                $message = "<p class='success'>Registration successful. <a href='login.php'>Login here</a>.</p>";
            } else {
                $message = "<p class='error'>Registration failed. Please try again.</p>";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="register-container">
  <h2>Create Account</h2>

  <?php if (!empty($message)) echo $message; ?>

  <form method="POST" action="">
    <label for="email">Email</label>
    <input
      type="email"
      id="email"
      name="email"
      placeholder="you@example.com"
      required
      value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
    />

    <label for="password">Password</label>
    <input
      type="password"
      id="password"
      name="password"
      placeholder="Enter a strong password"
      required
    />

    <input type="submit" value="Register" />
  </form>

  <div class="button-group">
    <a href="login.php" class="button">Back to Login</a>
  </div>
</div>

</body>
</html>
