@extends('elements.auth')

@section('content')
    @php
        use App\Helpers\Template;

        $flClass    = Config::get('gds.template.formLabel.class');
        $fiClass    = Config::get('gds.template.formInput.class');
        $statusEnum = Config::get('gds.enum.selectStatus');

        $id         = $data['id'] ?? null;
        $method     = ($id) ? 'PUT' : 'POST';
        $action     = ($id) ? route($routePrefix.'update', [$ctrl => $id]) : route($routePrefix.'store');
    @endphp

    <div class="row">
        @php
            $tt = (($id) ? 'Modify' : 'New').' '.$pageTitle;
            $stt = (($id) ? 'Update the' : 'Add the new').' '.$pageTitle.' information';
        @endphp

        @if ($id)
            <div class="col-12">
                <div class="row">
                    <div class="px-2">
                        @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                        @include($pathViewTemplate . 'error')
                    </div>

                        <div class="col-lg-4 col-md-6 col-md-12 mb-5">
                            @include($pathView.'edit')
                        </div>

                        <div class="col-lg-4 col-md-6 col-md-12 mb-5">
                            @include($pathView.'assign_role', ['tt' => 'Assign Role', 'stt' => 'Assign the Role for User'])
                        </div>

                        <div class="col-lg-4 col-md-6 col-md-12 mb-5">
                            @include($pathView.'change_password', ['tt' => 'Reset Password', 'stt' => 'Update the New Password for User'])
                        </div>
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

                    @include($pathView.'create')
                </div>
            </div>
        @endif

    </div>
@endsection
