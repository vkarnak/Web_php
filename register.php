<?php
session_start();
require_once 'db.php';
$db = getDB();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username && $password) {
        $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() > 0) {
            $error = 'Username already taken';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, $hash]);
            header('Location: login.php');
            exit;
        }
    } else {
        $error = 'Fill all fields';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h1>Register</h1>
<?php if ($error) echo '<p style="color:red;">'.$error.'</p>'; ?>
<form method="post">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login</a>.</p>
<p><a href="index.php">Home</a></p>
</body>
</html>
