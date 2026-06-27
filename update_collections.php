<?php

$mysqli = new mysqli("127.0.0.1", "root", "", "reema_shop");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Assign existing product to Tatreez collection
$mysqli->query("UPDATE products SET collection_id = 1 WHERE id = 3");
echo "Product 3 assigned to Tatreez collection\n";

$mysqli->close();
