<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
       $books = Book::when($request->search, function($query) use($request){
         return $query-> where('title', 'like', '%' . $request->search . '%')
           ->orWhere('author', 'like', '%' . $request->search . '%')
           ->orWhere('date_of_publish', 'like', '%' . $request->search . '%')
           ->orWhere('num_pages', 'like', '%' . $request->search . '%')
           ->orWhere('price', 'like', '%' . $request->search . '%');
        }) ->when($request->category_id, function($query) use($request){
             return $query->where('category_id',  $request->category_id);

        })->latest()->paginate(5);


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
