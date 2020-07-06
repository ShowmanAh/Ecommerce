<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
       // $this->middleware(['permission:read_users'])->only('index');
       // $this->middleware(['role:super_admin']);
    }
  public function index(){
      $categories_count = Category::count();
      $books_count = Book::count();
      $users_count = User::whereRoleIs('admin')->count();
     // dd($users_count);
      return view('dashboard.index', compact('categories_count', 'books_count', 'users_count'));
  }
}
