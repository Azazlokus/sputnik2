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
        Schema::table('relax_places', function (Blueprint $table) {
            $table->string('average_rating')->nullable()->change();
        });
    }
    public function down()
    {
        Schema::table('relax_places', function (Blueprint $table) {
            $table->string('average_rating')->change();
        });
    }
};
