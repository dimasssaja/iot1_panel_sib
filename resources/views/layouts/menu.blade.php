<div class="col-xl-2 w-100 m-0 p-0 col-md-3 col-sm-2" style="z-index: 100;">
    <ul class="position-fixed navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-flex flex-column justify-content-between"
        id="accordionSidebar">

        <div class="">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">IoT Panel<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Saklar -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('saklar') }}">
                    <i class="fas fa-toggle-off"></i>
                    <span>Saklar</span></a>
            </li>
            <!-- Nav Item - Device -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('device') }}">
                    <i class="fas fa-mobile"></i>
                    <span class="ml-2">Device</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span></a>
            </li>
        </div>

        <div class="mb-5 px-3">
            <a href="{{ route('dokumentasi') }}"
                class="btn btn-outline-light w-100 d-sm-none d-xl-block  d-md-block">Dokumentasi</a>
            <a href="" class="btn btn-outline-light w-100 d-lg-none d-md-none"><i class="fas fa-book-open"
                    style="color: white;"></i></a>
        </div>

    </ul>
</div>
