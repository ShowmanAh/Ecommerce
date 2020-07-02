@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Books

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dahboard</a></li>
                <li><a href="{{ route('books.index') }}"> Books</a></li>

            </ol>
        </section>

        <!-- Main content -->

        <!-- /.content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 20px"> <small>{{ $books->total() }}</small></h3>
                    <!-- search data -->
         <form action="{{ route('books.index')}}" method="get">
             <div class="row">
                 <div class="col-md-4">
                     <input type="text" name="search" class="form-control" placeholder="search books" value="{{ request()->search }}">
                 </div>
                 <div class="col-md-4">
                     <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i> Search</button>
                     @if (auth()->user()->hasPermission('create_books'))
                     <a href="{{ route('books.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> ADD</a>
                        @else
                        <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"> </i> ADD</a>
                     @endif

                 </div>
             </div>
         </form>

                </div><!-- end of box header -->
                <div class="box-body">
                    <!-- check user counts-->
                    @if($books->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>No_Pages</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $index=>$book)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                   <td>
                                    <img src="{{ $book->image_path}}" alt="" style="width: 50px; box-shadow: 3px 3px 1px #ccc;" class="image-thumbanil image-preview">
                                   </td>
                                    <td>{{ $book->title}}</td>

                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->price}}$</td>
                                    <td>{{ $book->num_pages}} page</td>
                                    <td>
                                       {{ strlen($book->description) > 50 ? substr($book->description,0, 50) . '.......' : $book->description}}
                                    </td>

                       <td>
                           @if (auth()->user()->hasPermission('update_books'))
                           <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info btn-sm">Edit</a>
                           @else
                           <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-trash"></i>Edit</a>
                           @endif


                           @if (auth()->user()->hasPermission('delete_books'))
                           <form action="{{ route('books.destroy', $book->id) }}" method="post" style="display: inline-block">
                            {{ csrf_field()}}
                            {{ method_field('delete')}}
                            <button class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                        </form>
                           @else
                           <button class="btn btn-danger btn-sm disabled">Delete</button>
                           @endif
                       </td>


                                </tr>
                                @endforeach
                            </tbody><!-- end tbody -->

                        </table><!-- end of table -->
                        <!--pagination link -->
                        <!--appends prevent guery search deleted from url -->
                       @else
                       <p> No Books Data Found<p>

                   @endif
                   {{ $books->appends(request()->query())->links() }}

                </div><!-- end of box body -->
            </div><!-- end of box  -->

        </section>
    </div>


@endsection
