@extends('elements.auth')

@section('content')
    <div class="row">

        @php
            $tt = (($id) ? 'Modify' : 'New').' '.$pageTitle;
            $stt = (($id) ? 'Update the' : 'Add the new').' '.$pageTitle.' information';
        @endphp

        @if ($id)

            <div class="col-10 offset-1">
                <div class="row">
                    @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                    @include($pathViewTemplate . 'error')

                    @include($pathView.'form_edit', ['tt' => $tt])
                    @include($pathView.'form_change_password', ['stt' => $stt])
                </div>
            </div>
        @else
            <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
                <div class="card card-body p-4">
                    <h6 class="mb-0">{{ $tt }}</h6>
                    <p class="text-sm mb-0">{{ $stt }}</p>
                    <hr class="horizontal dark my-3">

                    @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                    @include($pathViewTemplate . 'error')

                    @include($pathView.'form_add')
                </div>
            </div>
        @endif

    </div>
@endsection
