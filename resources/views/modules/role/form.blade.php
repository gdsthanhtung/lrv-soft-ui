@extends('elements.auth')

@section('content')
    @php
        $id         = $data['id'] ?? null;
        $flClass    = Config::get('gds.template.formLabel.class');
        $fiClass    = Config::get('gds.template.formInput.class');
        $statusEnum = Config::get('gds.enum.selectStatus');
        $method     = ($id) ? 'PUT' : 'POST';
        $action     = ($id) ? route($routePrefix.'update', [$ctrl => $data['id'], 'id' => $data['id']]) : route($routePrefix.'store');
        $name       = ($id) ? $data['name'] : '';
        $status     = ($id) ? $data['status'] : '';

        use App\Helpers\Template;
        $permission = $routeList;
        $permissionSelected = ($id) ? json_decode($data['permission']) : [];
    @endphp

    <div class="row">
        @php
            $tt = (($id) ? 'Modify' : 'New').' '.$pageTitle;
            $stt = (($id) ? 'Update the' : 'Add the new').' '.$pageTitle.' information';
        @endphp

        <div class="col-lg-6 col-md-8 col-sm-12 mx-auto mb-5">
            @includeWhen(session('notify'), $pathViewTemplate . 'notify')
            @include($pathViewTemplate . 'error')

            <div class="card card-body p-4">
                <h6 class="mb-0">{{ $tt }}</h6>
                <p class="text-sm mb-0">{{ $stt }}</p>
                <hr class="horizontal dark my-3">

                @include($pathView.'form_content')
            </div>
        </div>
    </div>
@endsection
