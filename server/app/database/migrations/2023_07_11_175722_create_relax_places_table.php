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
        Schema::create('relax_places', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->float('latitude');
            $table->float('longitude');
            $table->float('average_rating');
            $table->string('country');        //country - отдельная сущность,
                                              // по правилам нормализации БД, для них отдельную таблицу, а здесь только country_id
            $table->foreignId('category')->constrained('relax_place_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relax_places');
    }
};
