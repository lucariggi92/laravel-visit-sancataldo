<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = [
            ['name' => 'Arte & Architettura', 'color' => '#e74c3c'],
            ['name' => 'Food & Drink', 'color' => '#e67e22'],
            ['name' => 'Siti Archeologici', 'color' => '#3498db'],
            ['name' => 'Natura', 'color' => '#2ecc71'],
                    ];

                    foreach($categories as $category){
                        $newcategory = new Category();
                        $newcategory->name = $category["name"];
                        $newcategory->color =$category["color"];
                        $newcategory->save();
                    }
              
    }
}
