<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
public function index(){
    $books = Book::get();
    //dd($books);
    return view('site.books', compact('books'));
}
public function show($id){
    $book = Book::find($id);
    //dd($book);
    return view('site.show_books', compact('book'));
}
}
