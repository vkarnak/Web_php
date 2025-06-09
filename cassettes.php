<?php
session_start();
require_once 'db.php';
$db = getDB();
$cassettes = $db->query('SELECT * FROM cassettes')->fetchAll(PDO::FETCH_ASSOC);
$user_id = $_SESSION['user_id'] ?? null;
$rentals = [];
if ($user_id) {
    $stmt = $db->prepare('SELECT cassette_id FROM rentals WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $rentals = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cassettes</title>
</head>
<body>
<h1>Available Cassettes</h1>
<?php if ($user_id): ?>
<p><a href="account.php">My Account</a> | <a href="logout.php">Logout</a></p>
<?php else: ?>
<p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
<?php endif; ?>
<ul>
<?php foreach ($cassettes as $c): ?>
    <li>
        <strong><?php echo htmlspecialchars($c['title']); ?></strong> - <?php echo htmlspecialchars($c['description']); ?>
        <?php if ($user_id): ?>
            <?php if (in_array($c['id'], $rentals)): ?>
                (Rented)
            <?php else: ?>
                <a href="rent.php?id=<?php echo $c['id']; ?>">Rent</a>
            <?php endif; ?>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
<p><a href="index.php">Home</a></p>
</body>
</html>
