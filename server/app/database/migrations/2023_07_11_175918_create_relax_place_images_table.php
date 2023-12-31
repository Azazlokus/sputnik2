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
        Schema::create('relax_place_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('relax_place_id')->constrained('relax_places')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image_name')->unique();
            $table->string('path_to_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relax_place_images');
    }
};
