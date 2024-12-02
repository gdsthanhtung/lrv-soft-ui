<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('/assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="...">
            <span class="ms-3 font-weight-bold">Gds Admin</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach($menus as $menu)
                @php
                    // Determine if the parent menu is active
                    $isActiveParent = Request::is(trim($menu->url, '/') . '*');
                    $isActiveChild = false;
                    $canAccessChild = false;

                    // Iterate through children to determine active state and access
                    foreach ($menu->children as $child) {
                        if (Request::is(trim($child->url, '/') . '*')) {
                            $isActiveChild = true;
                        }
                        if (empty($child->permission) || Auth::user()->can($child->permission)) {
                            $canAccessChild = true;
                        }
                    }
                @endphp

                @if(empty($menu->permission) || Auth::user()->can($menu->permission) || $canAccessChild)
                    <li class="nav-item">
                        <a class="nav-link {{ $isActiveParent || $isActiveChild ? 'active' : '' }}"
                           href="{{ $menu->url ? url($menu->url) : '#' }}"
                           @if($menu->children->count() > 0)
                               data-bs-toggle="collapse" data-bs-target="#menu-{{ $menu->id }}"
                               aria-expanded="{{ $isActiveChild ? 'true' : 'false' }}"
                           @endif>
                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i style="font-size: 1rem;"
                                   class="fas fa-lg {{ $menu->icon }} ps-2 pe-2 text-center text-dark {{ $isActiveParent || $isActiveChild ? 'text-white' : 'text-dark' }}"
                                   aria-hidden="true"></i>
                            </div>
                            <span class="nav-link-text ms-1">{{ $menu->name }}</span>
                        </a>
                        @if($menu->children->count() > 0)
                            <div class="collapse {{ $isActiveChild ? 'show' : '' }}" id="menu-{{ $menu->id }}">
                                <ul class="nav ms-4 ps-3">
                                    @foreach($menu->children as $child)
                                        @if(empty($child->permission) || Auth::user()->can($child->permission))
                                            <li class="nav-item {{ Request::is(trim($child->url, '/') . '*') ? 'active' : '' }}">
                                                <a class="nav-link {{ Request::is(trim($child->url, '/') . '*') ? 'active' : '' }}" href="{{ url($child->url) }}">
                                                    <span class="sidenav-normal">{{ $child->name }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>
