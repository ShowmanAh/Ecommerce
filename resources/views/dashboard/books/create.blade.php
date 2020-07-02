@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>Users</h1>

        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('books.index') }}">Books</a></li>
            <li class="active">Add User</li>
        </ol>
    </section>
    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Add Book</h3>
            </div><!-- end of box header -->

            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     {{ method_field('post') }}
                          <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" name="title" class="form-control" placeholder="Book Title" value="{{ old('title')}}">
                          </div>
                          <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" placeholder="Author Name" value="{{ old('author')}}">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control image">
                        </div><div class="form-group">
                           <img src="{{asset('uploads/books/default.jpg')}}" alt="" class="img-thumbnail image-preview" style="width: 200px" >
                        </div>
                        <div class="form-group">
                            <label for="date_of_publish">Publish Date</label>
                            <input type="date" name="date_of_publish" class="form-control" value="{{ old('date_of_publish')}}">
                        </div>
                        <div class="form-group">
                            <label for="num_pages"> Number Pages</label>
                            <input type="number" name="num_pages" step="1" class="form-control" value="{{ old('num_pages')}}">
                        </div
                         <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" step="1" class="form-control" value="{{ old('price')}}">
                        </div>
                       <div class="form-group">
                            <textarea name="description"  cols="5" rows="10" class="form-control" placeholder="book description">{{ old('description')}}</textarea>
                       </div>

                        <div class="form-group">
                            <label for="category_id">Categories</label>
                            <select name="category_id" class="form-control">
                                <option value="">Categories</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id}}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name}}</option>
                            @endforeach
                           </select>

                        </div>



                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">Add Book</button>
                             </div>
                </form>
            </div>
        </div>
    </section>
@endsection
