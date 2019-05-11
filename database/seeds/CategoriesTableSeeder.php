<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::firstOrCreate(['name' => 'Books']);
        $categories = Category::firstOrCreate(['name' => 'Lectures']);
        $categories = Category::firstOrCreate(['name' => 'Domitory']);
        $categories = Category::firstOrCreate(['name' => 'Electronics']);
        $categories = Category::firstOrCreate(['name' => 'News']);
        $categories = Category::firstOrCreate(['name' => 'Oethers']);
    }
}
