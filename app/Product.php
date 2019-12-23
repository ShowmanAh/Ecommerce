<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'image','price','description'];
    protected $append = ['image_path'];
    //get public path image
    public function getImagePathAttribute(){
        return asset('uploads/products/' . $this->image);
    }
}
