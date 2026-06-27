<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('filename');
            $table->string('mime_type')->default('video/mp4');
            $table->unsignedBigInteger('file_size');
            $table->timestamps();
        });

        // Add LONGBLOB column using raw SQL (Laravel doesn't support longBlob method)
        DB::statement('ALTER TABLE videos ADD COLUMN video_data LONGBLOB AFTER filename');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
