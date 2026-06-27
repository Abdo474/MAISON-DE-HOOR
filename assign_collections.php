<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

try {
    // Update product ID 3 to be in Tatreez collection (ID 1)
    \DB::table('products')->where('id', 3)->update(['collection_id' => 1]);
    
    echo "✓ Product assigned to collection!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
