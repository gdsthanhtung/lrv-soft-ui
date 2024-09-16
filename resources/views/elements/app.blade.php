<!DOCTYPE html>
<html lang="en" >
    <head>
        @include('elements.head')
    </head>
    <body class="g-sidenav-show  bg-gray-100">
        @auth
            @yield('auth')
        @endauth

        @guest
            @yield('guest')
        @endguest

        @if(session()->has('success'))
        <div x-data="{ show: true}"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
            <p class="m-0">{{ session('success')}}</p>
        </div>
        @endif
        @include('elements.script')
    </body>
</html>
