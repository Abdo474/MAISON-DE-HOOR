<?php
$host = '127.0.0.1';
$db = 'reema_shop';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "=== COLLECTIONS ===\n";
$result = $mysqli->query("SELECT id, name, slug, video_id FROM collections");
while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']}, Name: {$row['name']}, Slug: {$row['slug']}, Video ID: {$row['video_id']}\n";
}

echo "\n=== VIDEOS ===\n";
$result = $mysqli->query("SELECT id, name, filename FROM videos LIMIT 5");
while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']}, Name: {$row['name']}, Filename: {$row['filename']}\n";
}

$mysqli->close();
