<?php
function getDB() {
    static $db = null;
    if ($db === null) {
        if (!file_exists(__DIR__ . '/data')) {
            mkdir(__DIR__ . '/data', 0777, true);
        }
        $dbPath = __DIR__ . '/data/database.db';
        $init = !file_exists($dbPath);
        $db = new PDO('sqlite:' . $dbPath);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($init) {
            initDB($db);
        }
    }
    return $db;
}

function initDB($db) {
    $db->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE,
        password TEXT
    )');
    $db->exec('CREATE TABLE IF NOT EXISTS cassettes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT,
        description TEXT
    )');
    $db->exec('CREATE TABLE IF NOT EXISTS rentals (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        cassette_id INTEGER,
        rented_at TEXT
    )');
    // Insert sample cassettes if table empty
    $count = $db->query('SELECT COUNT(*) FROM cassettes')->fetchColumn();
    if ($count == 0) {
        $stmt = $db->prepare('INSERT INTO cassettes (title, description) VALUES (?, ?)');
        $samples = [
            ['The Matrix', 'Sci-fi classic'],
            ['Back to the Future', 'Time travel adventure'],
            ['The Lion King', 'Animated musical drama']
        ];
        foreach ($samples as $s) {
            $stmt->execute($s);
        }
    }
}
?>
