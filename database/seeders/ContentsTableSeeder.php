<?php

namespace Database\Seeders;
use App\Models\Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            [
               
                'title' => 'Chiesa Madre',
                'description' => 'La chiesa principale di San Cataldo',
                'time_needed_visiting' => 30,
                'food_type' => null,
                 'category_id' => Category::where('name', 'Arte & Architettura')->first()->id,
            ],
            [
                
                'title' => 'Arancina agli Spaghetti',
                'description' => 'Specialità presso X Pasticceria',
                'time_needed_visiting' => 20,
                'food_type' => 'spuntino',
                'category_id' => Category::where('name', 'Food & Drink')->first()->id,
            ],
            [
                
                'title' => 'Vasallaggi',
                'description' => 'Sito archeologico di Vasallaggi',
                'time_needed_visiting' => 60,
                'food_type' => null,
                'category_id' => Category::where('name', 'Siti Archeologici')->first()->id,
            ],
            [
                
                'title' => 'Gabbara',
                'description' => 'Area naturale della Gabbara',
                'time_needed_visiting' => 90,
                'food_type' => null,
                'category_id' => Category::where('name', 'Natura')->first()->id,
            ],  
        ];
        


        foreach ($contents as $content) {
        $newContent = new Content();
        
        $newContent->title = $content["title"];
        $newContent->description = $content["description"];
        $newContent->time_needed_visiting = $content['time_needed_visiting'];
        $newContent->food_type = $content['food_type'];
        $newContent->category_id = $content['category_id'];

        $newContent->save();
        }

    }
}
