<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once 'db.php';
$db = getDB();
$stmt = $db->prepare('SELECT c.title, r.rented_at FROM rentals r JOIN cassettes c ON r.cassette_id = c.id WHERE r.user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account</title>
</head>
<body>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
<p><a href="cassettes.php">Browse cassettes</a> | <a href="logout.php">Logout</a></p>
<h2>Your Rentals</h2>
<?php if (empty($rentals)): ?>
<p>No rentals yet.</p>
<?php else: ?>
<ul>
<?php foreach ($rentals as $r): ?>
    <li><?php echo htmlspecialchars($r['title']).' ('.htmlspecialchars($r['rented_at']).')'; ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<p><a href="index.php">Home</a></p>
</body>
</html>
