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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('category');
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // Untuk menyimpan path gambar
            $table->boolean('is_featured')->default(false); // Untuk "pilih yg mana yg mau ditaruh di dashboard"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};