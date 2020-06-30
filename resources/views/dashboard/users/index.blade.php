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
                    <h3 class="box-title" style="margin-bottom: 20px"> <small>{{ $users->count() }}</small></h3>
                    <!-- search data -->
         <form action="{{ route('users.index')}}" method="get">
             <div class="row">
                 <div class="col-md-4">
                     <input type="text" name="search" class="form-control" placeholder="search user" value="{{ request()->search }}">
                 </div>
                 <div class="col-md-4">
                     <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-search"></i> Search</button>
                     <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> ADD</a>
                 </div>
             </div>
         </form>

                </div><!-- end of box header -->
                <div class="box-body">
                    <!-- check user counts-->
                    @if($users->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index=>$user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name}}</td>

                                    <td>{{ $user->email }}</td>

                       <td>
                           <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>

                           <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block">
                               {{ csrf_field()}}
                               {{ method_field('delete')}}
                               <button class="btn btn-danger btn-sm">Delete</button>
                           </form>
                       </td>


                                </tr>
                                @endforeach
                            </tbody><!-- end tbody -->

                        </table><!-- end of table -->
                        <!--pagination link -->
                        <!--appends prevent guery search deleted from url -->
                       @else
                       <p> No Users Data Found<p>
                        {{ $users->appends(request()->query())->links() }}
                   @endif


                </div><!-- end of box body -->
            </div><!-- end of box  -->

        </section>
    </div>


@endsection
