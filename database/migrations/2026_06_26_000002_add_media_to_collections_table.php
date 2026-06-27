<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->string('media')->nullable(); // File path
            $table->enum('media_type', ['video', 'photo'])->nullable(); // Type indicator
        });
    }

    public function down(): void
    {
        Schema::table('collections', function (Blueprint $table) {
            $table->dropColumn(['media', 'media_type']);
        });
    }
};
