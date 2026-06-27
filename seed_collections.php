<?php

require 'bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make('Illuminate\Contracts\Console\Kernel');

$kernel->bootstrap();

$seeder = new \Database\Seeders\CollectionSeeder();
$seeder->run();

echo "Collections seeded successfully!\n";
