<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Collection;
use App\Models\Video;

echo "\n=== COLLECTIONS ===\n";
$collections = Collection::all();
foreach ($collections as $c) {
    echo "ID: {$c->id}, Name: {$c->name}, Slug: {$c->slug}, Video ID: {$c->video_id}\n";
}

echo "\n=== VIDEOS ===\n";
$videos = Video::all();
foreach ($videos as $v) {
    echo "ID: {$v->id}, Name: {$v->name}, Size: {$v->file_size} bytes\n";
}
