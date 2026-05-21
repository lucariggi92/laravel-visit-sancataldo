<?php

namespace Database\Seeders;
use App\Models\Mood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = [
            ['name' => 'curioso'],
            ['name' => 'avventuriero'],
            ['name' => 'rilassato'],
            
        ];

        foreach ($moods as $mood) {
            $newMood = new Mood();
            $newMood->name = $mood['name'];
            $newMood->save();
        }
    }
}
