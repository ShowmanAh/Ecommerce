@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>Users</h1>

        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li class="active">Add User</li>
        </ol>
    </section>
    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Add Category</h3>
            </div><!-- end of box header -->

            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     {{ method_field('post') }}
                          <div class="form-group">
                              <label for="name">Category Name</label>
                              <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{ old('name')}}">
                          </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">Add Category</button>
                             </div>
                </form>
            </div>
        </div>
    </section>
@endsection
