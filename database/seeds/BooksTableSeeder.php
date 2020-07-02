<?php

//use App\Models\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\ Book::create([
            'title' => 'ayam',
             'author' => 'showman',
             //'date_of_publish'=> '2008',
            'num_pages'=> 500,
            'price' => 100,
            'description' => 'is abeutiful book for taha hussien',
            'category_id'=> 1,
        ]);
    }
}
