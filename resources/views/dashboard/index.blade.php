@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Dashboard</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i>Dashboard</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                {{-- categories--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        @if (auth()->user()->hasPermission('read_categories'))
                        <div class="inner">

                            <h3>{{ $categories_count }}</h3>

                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('categories.index') }}" class="small-box-footer"> read<i class="fa fa-arrow-circle-right"></i></a>


                       @endif
                    </div>
                </div>

                {{--products--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        @if (auth()->user()->hasPermission('read_books'))
                        <div class="inner">
                            <h3>{{ $books_count }}</h3>

                            <p>Books</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('books.index') }}" class="small-box-footer">read <i class="fa fa-arrow-circle-right"></i></a>

                        @endif
                          </div>
                </div>

                {{--clients--}}


                {{--users--}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        @if (auth()->user()->hasPermission('read_users'))
                        <div class="inner">
                            <h3>{{ $users_count }}</h3>

                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer"> read<i class="fa fa-arrow-circle-right"></i></a>

                        @endif
                         </div>
                </div>

            </div><!-- end of row -->



        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection

