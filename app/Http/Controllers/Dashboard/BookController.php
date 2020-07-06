<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');//check authentication
        // chech permission for user
        $this->middleware(['permission:read_books'])->only('index');
        $this->middleware(['permission:create_books'])->only('create');
        $this->middleware(['permission:update_books'])->only('update');
        $this->middleware(['permission:delete_books'])->only('destroy');
    }
    public function index(Request $request)
    {
        $categories = Category::all();
       // dd($request->all());
       $books = Book::when($request->search, function($query) use($request){
         return $query->where('title', 'like', '%' . $request->search . '%')
           ->orWhere('author', 'like', '%' . $request->search . '%')
           ->orWhere('date_of_publish', 'like', '%' . $request->search . '%')
           ->orWhere('num_pages', 'like', '%' . $request->search . '%')
           ->orWhere('price', 'like', '%' . $request->search . '%');
        })->when($request->category_id, function ($query) use ($request) {

            return $query->where('category_id', $request->category_id);

        })->latest()->paginate(5);
   //dd($books);

       //dd($books);
       return view('dashboard.books.index', compact('categories','books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = Category::all();
       return view('dashboard.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request_data = $this->validate_data($request);
      // $this->image_upload($request);
      if ($request->image) {
        Image::make($request->image)
        ->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })
        ->save(public_path('uploads/books/' . $request->image->hashName()));

       $request_data['image'] = $request->image->hashName();
       }
       Book::create($request_data);
       session()->flash('success', __('Book Added Successfully'));
       return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $book = Book::find($id);
        return view('dashboard.books.edit', compact(['categories', 'book']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $request_data = $this->validate_data($request);
        //$this->image_upload($request);
        if ($request->image) {

            if ($book->image != 'default.jpg') {

                Storage::disk('public_uploads')->delete('/books/' . $book->image);

            }//end of if

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/books/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        $book->update($request_data);
        session()->flash('success', __('Book Updated Successfully'));
        return redirect()->route('books.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book->image != 'default.jpg') {

            Storage::disk('public_uploads')->delete('/books/' . $book->image);

        }//end of if
        $book->delete();
        session()->flash('success', __('Book Deleted Successfully'));
        return redirect()->route('books.index');
    }
    public function validate_data(Request $request){
      $validate_request = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'date_of_publish' => 'required',
        'price' => 'required',
        'num_pages' => 'required',
        'description' => 'required|max:200',
        'category_id' => 'required',
      ]);
      return $validate_request;
    }
    public function image_upload(Request $request){
        if ($request->image) {
         $image =  Image::make($request->image)->resize(300, null, function($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/books/' . $request->image->hashName(), 60));

        }

     return $image;
    }

}
