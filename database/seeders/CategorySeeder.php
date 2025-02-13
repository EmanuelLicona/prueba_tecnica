<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $category = new Category();
         $category->name = 'Category 1';
         $category->description = 'Description 1';
         $category->save();

         $category2 = new Category();
         $category2->name = 'Category 2';
         $category2->description = 'Description 2';
         $category2->save();
    }
}
