<?php

// Connect to database
$mysqli = new mysqli("127.0.0.1", "root", "", "reema_shop");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected to database successfully!\n";

// Create videos table
$sql = "CREATE TABLE IF NOT EXISTS videos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    filename VARCHAR(255) NOT NULL,
    video_data LONGBLOB NOT NULL,
    mime_type VARCHAR(255) DEFAULT 'video/mp4',
    file_size BIGINT UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($mysqli->query($sql)) {
    echo "✓ Videos table created successfully!\n";
} else {
    echo "Error creating videos table: " . $mysqli->error . "\n";
}

// Add video_id to collections table
$sql = "ALTER TABLE collections ADD COLUMN video_id BIGINT UNSIGNED NULL";

if ($mysqli->query($sql)) {
    echo "✓ video_id column added to collections table!\n";
} else if (strpos($mysqli->error, "Duplicate column") !== false) {
    echo "✓ video_id column already exists in collections table\n";
} else {
    echo "Error adding video_id: " . $mysqli->error . "\n";
}

// Add foreign key constraint
$sql = "ALTER TABLE collections ADD CONSTRAINT collections_video_id_foreign FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE SET NULL";

if ($mysqli->query($sql)) {
    echo "✓ Foreign key constraint added!\n";
} else if (strpos($mysqli->error, "Duplicate key") !== false) {
    echo "✓ Foreign key constraint already exists\n";
} else {
    echo "Error adding foreign key: " . $mysqli->error . "\n";
}

echo "\n✅ All database migrations completed successfully!\n";

$mysqli->close();
