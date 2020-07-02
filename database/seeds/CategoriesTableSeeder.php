<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['cat1', 'cat2','cat3'];
        foreach($categories as $category){
            App\Models\Category::create([
                'name'=> $category,
            ]);
        }
    }
}
