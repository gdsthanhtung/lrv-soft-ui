@extends('elements.auth')

@section('content')
    @php
        $flClass = Config::get('gds.template.formLabel.class');
        $fiClass = Config::get('gds.template.formInput.class');

        $statusEnum = Config::get('gds.enum.selectStatus');
        $levelEnum  = Config::get('gds.enum.selectLevel')['value'];
        $task       = ($id) ? 'edit' : 'add';
    @endphp
    <div class="row">

        @php
            $tt = (($id) ? 'Modify' : 'New').' '.$pageTitle;
            $stt = (($id) ? 'Update the' : 'Add the new').' '.$pageTitle.' information';
        @endphp

        @if ($id)
            <div class="col-10 offset-1">
                <div class="row">
                    <div class="px-2">
                        @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                        @include($pathViewTemplate . 'error')
                    </div>

                    @include($pathView.'form_edit')
                    @include($pathView.'form_change_password', ['tt' => 'Reset Password', 'stt' => 'Update the New Password for User'])
                </div>
            </div>
        @else
            <div class="col-lg-6 col-md-8 col-sm-12 mx-auto mb-5">
                @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                @include($pathViewTemplate . 'error')

                <div class="card card-body p-4">
                    <h6 class="mb-0">{{ $tt }}</h6>
                    <p class="text-sm mb-0">{{ $stt }}</p>
                    <hr class="horizontal dark my-3">

                    @include($pathView.'form_add')
                </div>
            </div>
        @endif

    </div>
@endsection
