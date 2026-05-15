<?php

namespace Database\Seeders;
use App\Models\Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $contents = [
            [
                'title' => 'Primo contenuto',
                'description' => 'Descrizione del primo contenuto',
            ],
            [
                'title' => 'Secondo contenuto',
                'description' => 'Descrizione del secondo contenuto',
            ],
            [
                'title' => 'Terzo contenuto',
                'description' => 'Descrizione del terzo contenuto',
            ],
        ];


        foreach ($contents as $content) {
        $newContent = new Content();
        
        $newContent->title = $content["title"];
        $newContent->description = $content["description"];

        $newContent->save();
        }

    }
}
