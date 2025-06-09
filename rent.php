<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once 'db.php';
$db = getDB();
$id = $_GET['id'] ?? null;
if ($id) {
    // check if already rented by user
    $stmt = $db->prepare('SELECT COUNT(*) FROM rentals WHERE user_id = ? AND cassette_id = ?');
    $stmt->execute([$_SESSION['user_id'], $id]);
    if ($stmt->fetchColumn() == 0) {
        $stmt = $db->prepare('INSERT INTO rentals (user_id, cassette_id, rented_at) VALUES (?, ?, datetime("now"))');
        $stmt->execute([$_SESSION['user_id'], $id]);
    }
}
header('Location: cassettes.php');
exit;
?>
