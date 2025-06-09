<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cassette Rental</title>
</head>
<body>
<h1>Welcome to Cassette Rental</h1>
<?php if (isset($_SESSION['user_id'])): ?>
<p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>! <a href="account.php">My Account</a> | <a href="logout.php">Logout</a></p>
<?php else: ?>
<p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
<?php endif; ?>
<p><a href="cassettes.php">Browse Cassettes</a></p>
</body>
</html>
