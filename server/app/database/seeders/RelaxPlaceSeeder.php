<?php

namespace Database\Seeders;

use App\Models\RelaxPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelaxPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('relax_places')->insert([
            [
                'title' => 'Ласточкин хвост',
                'description' => 'Место в Крыму',
                'latitude' => 28.35,
                'longitude' => 22.23,
                'average_rating' => 5,
                'country' => 'Russia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Лас-Вегас',
                'description' => 'Место в Америке',
                'latitude' => 328.35,
                'longitude' => 283.25,
                'average_rating' => 4,
                'country' => 'USA',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        RelaxPlace::factory()
            ->count(10)
            ->create();
    }
}