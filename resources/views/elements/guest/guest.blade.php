@extends('elements.app')

@section('guest')
    @if(\Request::is('login/forgot-password'))
        @yield('content')
    @else
        @yield('content')
        @include('elements.guest.footer')
    @endif
@endsection
