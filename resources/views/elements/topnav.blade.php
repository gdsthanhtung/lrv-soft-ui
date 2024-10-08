<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            @php
                $bc = str_replace('/', ' / ', str_replace('-', ' ', Request::path()));
            @endphp
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ url('admin/dashboard') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ $bc }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ $bc }}</h6>
        </nav>
        <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
            <a href="javascript:;" class="nav-link text-body p-0">
            <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            </div>
            </a>
            </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
                <a href="{{ url('admin/logout')}}" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Sign Out</span>
                </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
                </a>
            </li>
        </div>
    </div>
</nav>
<!-- End Navbar -->
