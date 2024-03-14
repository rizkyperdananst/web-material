<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard.index') }}">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img src="{{ url('assets/img/bg-login-image.jpeg') }}" class="img rounded-circle" width="50" alt="Logo">
        </div>
        <div class="sidebar-brand-text mx-3">Material</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Material -->
    <li class="nav-item {{ Request::is('admin/komoditas*') ? 'active' : '' }}">
        <a class="nav-link mb-0 pb-0" href="{{ route('admin.komoditas.index') }}">
            <i class="fa-solid fa-sitemap"></i>
            <span>Komoditas</span></a>
    </li>

    <!-- Nav Item - Material -->
    <li class="nav-item {{ Request::is('admin/material*') ? 'active' : '' }}">
        <a class="nav-link mb-0 pb-0" href="{{ route('admin.material.index') }}">
            <i class="fa-solid fa-sitemap"></i>
            <span>Material</span></a>
    </li>

    <!-- Nav Item - Penjualan -->
    <li class="nav-item {{ Request::is('admin/penjualan*') ? 'active' : '' }}">
        <a class="nav-link mb-0 pb-0" href="{{ route('admin.penjualan.index') }}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Penjualan</span></a>
    </li>

    <!-- Nav Item - Pengeluaran -->
    <li class="nav-item {{ Request::is('admin/expenditure*') ? 'active' : '' }}">
        <a class="nav-link mb-0 pb-0" href="{{ route('admin.expenditure.index') }}">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Pengeluaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Setting
    </div>

    <!-- Nav Item - Pages Setting Menu -->
    <li class="nav-item {{ Request::is('admin/export*') || Request::is('admin/user*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fa-solid fa-gear"></i>
            <span>Setting</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Setting Screens:</h6>
                @role('owner')
                    <a class="collapse-item" href="{{ route('admin.user.index') }}">User</a>
                    <a class="collapse-item" href="{{ route('admin.export.index') }}">Export</a>
                @endrole
                <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="collapse-item btn btn-light" style="font-size: 14px">Logout</button>
                </form>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
