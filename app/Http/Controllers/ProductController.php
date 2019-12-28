<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
//use Session;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $products = Product::paginate(3);
        return view('products.index', compact('products'));
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'description' => 'required|max:50'

        ]);
        $request_data = $request->except(['image']);
        if($request->image){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();// keep relation between width and height
                //hashname get image name and make encrypt for name return unique name
            })->save(public_path('uploads/products/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        Product::create($request_data);

        session()->flash('success', 'Product created successfully.');

        return redirect()->route('products.index');



    }
    public function edit($id){
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request,$id){
        $product = Product::find($id);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image',
            'description' => 'required|max:50'

        ]);
        $request_data = $request->except(['image']);
        if($request->image){
            //check image default to delete users image when deleted
            if($product->image != 'default.png'){
                //delete public_uploads exist in file system
                Storage::disk('public_uploads')->delete('/products/' . $product->image);
            }//end inner if
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();// keep relation between width and height
                //hashname get image name and make encrypt for name return unique name
            })->save(public_path('uploads/products/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }//e
        $product->update($request_data);
        session()->flash('success', 'product updated successfully');
        return redirect()->route('products.index');



    }
    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
    }

}
