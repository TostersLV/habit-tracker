<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            ['name' => 'Amazing!'],
            ['name' => 'Good'],
            ['name' => 'Tiring'],
            ['name' => 'Bad'],
            ['name' => 'Horrible'],
        ];

        \DB::table('moods')->insert($insert);
    }
}
