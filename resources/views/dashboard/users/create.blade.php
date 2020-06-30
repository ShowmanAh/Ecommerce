@extends('layouts.dashboard.app')
@section('content')
<div class="content-wrapper">

    <section class="content-header">

        <h1>Users</h1>

        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li class="active">Add User</li>
        </ol>
    </section>
    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">Add User</h3>
            </div><!-- end of box header -->

            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     {{ method_field('post') }}
                          <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control" placeholder="your Name" value="{{ old('name')}}">
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="your Email" value="{{ old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="your password" value="{{ old('password')}}">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmationame">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" value="{{ old('password_confirmation')}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">Add User</button>
                             </div>
                </form>
            </div>
        </div>
    </section>
@endsection
