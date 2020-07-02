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
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control image" >
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('uploads/user_images/default.jpg')}}" class="img-thumbnail image-preview" alt="">
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
                            <label>Permissions</label>
                            <div class="nav-tabs-custom">

                                @php
                                // dry method dont repeate your self
                                    $models = ['users', 'categories', 'books'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index=>$model)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">{{ $model }}</a></li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">

                                    @foreach ($models as $index=>$model)

                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            @foreach ($maps as $map)
                                                <label><input type="checkbox" name="permissions[]" value="{{ $map . '_' . $model}}"> {{ $map }}</label>
                                            @endforeach

                                        </div>

                                    @endforeach

                                </div><!-- end of tab content -->

                            </div><!-- end of nav tabs -->

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">Add User</button>
                             </div>
                </form>
            </div>
        </div>
    </section>
@endsection
