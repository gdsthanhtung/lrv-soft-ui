@extends('elements.app')

@section('auth')

    @include('elements.menu')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
        @include('elements.topnav')

        <div class="container-fluid py-4">
            @yield('content')
            @include('elements.footer')
        </div>
    </main>

@endsection
