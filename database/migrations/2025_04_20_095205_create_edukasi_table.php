<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('edukasi', function (Blueprint $table) {
            $table->id();
            $table->string('topik');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->string('konten');
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasi');
    }
};
