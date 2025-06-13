<?php
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Email Already Registered</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<div class="register-container" style="max-width: 500px; margin: 50px auto; text-align: center;">
    <h2>Email Already Registered</h2>
    <p>The email <strong><?php echo $email; ?></strong> is already registered.</p>
    <p>Please <a href="login.php">login here</a> or use a different email to register.</p>
    <a href="register.php" class="button" style="margin-top: 20px; display: inline-block;">Back to Register</a>
</div>

</body>
</html>
