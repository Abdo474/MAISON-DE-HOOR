<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$logo = \App\Models\Logo::first();
if ($logo) {
    $logo->filename = 'logo.svg';
    $logo->path = 'images/logo.svg';
    $logo->save();
    echo "Logo updated successfully!\n";
} else {
    echo "No logo found\n";
}
