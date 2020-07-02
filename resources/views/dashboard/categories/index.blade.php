@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Users

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dahboard</a></li>
                <li><a href="{{ route('users.index') }}"> Users</a></li>

            </ol>
        </section>

        <!-- Main content -->

        <!-- /.content -->
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 20px"> <small>{{ $categories->count() }}</small> Categories</h3>
                    <!-- search data -->

             <div class="row">

                 <div class="col-md-4">
                     @if (auth()->user()->hasPermission('create_categories'))
                     <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> Add </a>
                        @else
                        <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"> </i> ADD</a>
                     @endif

                 </div>
             </div>


                </div><!-- end of box header -->
                <div class="box-body">
                    <!-- check user counts-->
                    @if($categories->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index=>$category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name}}</td>



                       <td>
                           @if (auth()->user()->hasPermission('update_categories'))
                           <a href=" {{ route('categories.edit', $category->id) }}"" class="btn btn-info btn-sm">Edit</a>
                           @else
                           <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-trash"></i>Edit</a>
                           @endif


                           @if (auth()->user()->hasPermission('delete_categories'))
                           <form action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: inline-block">
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
                       <p> No Users Data Found<p>

                   @endif


                </div><!-- end of box body -->
            </div><!-- end of box  -->

        </section>
    </div>


@endsection
