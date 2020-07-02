<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">

            <li><a href="{{ url('/dashboard/index') }}"><i class="fa fa-th"></i><span>Dashboard</span></a></li>
                @if (auth()->user()->hasPermission('read_users'))
                <li><a href="{{ route('users.index')}}"><i class="fa fa-th"></i><span>Users</span></a></li>

                @endif

                @if (auth()->user()->hasPermission('read_categories'))
                <li><a href="{{ route('categories.index')}}"><i class="fa fa-th"></i><span>Categories</span></a></li>

                @endif

                @if (auth()->user()->hasPermission('read_books'))
                <li><a href="{{ route('books.index')}}"><i class="fa fa-th"></i><span>Books</span></a></li>

                @endif
        </ul>



    </section>

</aside>

