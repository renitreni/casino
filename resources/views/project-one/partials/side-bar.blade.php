<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('theme/admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ asset('theme/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image"> --}}
                <i class="fas fa-circle text-success mt-2"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block user-email"></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">User Management</li>
                <li class="nav-item">
                    <a href="{{ route('agents') }}" class="nav-link @if(Route::getCurrentRoute()->uri == 'agents') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Agents</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('players') }}" class="nav-link @if(Route::getCurrentRoute()->uri == 'players') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Players</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admins') }}" class="nav-link @if(Route::getCurrentRoute()->uri == 'admins') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Admins</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
