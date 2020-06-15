<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img src="{{ asset('assets/frontend/images/favicon-32x32.png') }}" alt="Logo">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel News') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ Auth::user()->id === 1 ? route('admin.dashboard') : route('author.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Resource
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('auth.posts.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Posts</span>
        </a>
        @if (Auth::user()->id == 1)
            <a class="nav-link" href="{{ route('admin.post.pending') }}">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>Pending Posts</span>
            </a>
            <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="fas fa-fw fa-th-list"></i>
                <span>Categories</span>
            </a>
            <a class="nav-link" href="{{ route('admin.tag.index') }}">
                <i class="fas fa-fw fa-tag"></i>
                <span>Tags</span>
            </a>
        @endif
    </li>

    @if (Auth::user()->id == 1)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Users
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.author.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Authors</span>
        </a>
        <a class="nav-link" href="{{ route('admin.subscriber.index') }}">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Subscribers</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
