@extends('elements.auth')

@section('content')
    <div class="row">
        <div class="col-6 mx-auto">
            <div class="card card-body mt-4">
                @php
                    $tt = ((!$id) ? 'New' : 'Modify').' '.$pageTitle;
                    $stt = ((!$id) ? 'Create the new' : 'Modify the').' '.$pageTitle;
                @endphp
                <h6 class="mb-0">{{ $tt }}</h6>
                <p class="text-sm mb-0">{{ $stt }}</p>
                <hr class="horizontal dark my-3">

                @if (session('notify'))
                    @include($pathViewTemplate . 'notify')
                @endif

                @include($pathViewTemplate . 'error')

                @if ($id)
                    <div class="row">
                        @include($pathView.'form_edit')
                        @include($pathView.'form_change_password')
                    </div>
                @else
                    @include($pathView.'form_add')
                @endif
            </div>
        </div>
    </div>
@endsection
