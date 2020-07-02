<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'date_of_publish', 'num_pages', 'price', 'description', 'category_id', 'image'];
   protected $append = ['image_path']; // append image
   // accessors
   public function getImagePathAttribute(){
       return asset('uploads/books/' . $this->image);
   }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
