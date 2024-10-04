@extends('elements.auth')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">

            @include($pathViewTemplate . 'page_header',
            [
                'title' => $pageTitle. ' management',
                'subTitle' => 'The '.$pageTitle. ' information list',
                'button' => '<a href="'.route('admin.'.$ctrl.'.form').'" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Add New</a>'
            ])

            <div class="m-3 mb-0">
                @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                @include($pathViewTemplate . 'error')
            </div>

            <div class="card-body px-0 pb-0 pt-0">
                <div class="table-responsive">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        {{-- <form action="{{ route('admin.'.$ctrl) }}" method="post" name="filterForm" id="filterForm"> --}}
                            <div class="dataTable-top">
                                <x-button.filter :ctrl="$ctrl" :countByStatus="[]" :params="$params" />
                                <x-search.area :ctrl="$ctrl" :params="$params" />
                            </div>

                            @include($pathView.'list')

                            @include($pathViewTemplate.'pagination')
                        {{-- </form> --}}
                        {{-- @include($pathView.'list_filter') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modules_script')
    <script src="{{ asset('assets/gds-custom/gds/js/modules_filter.js') }}"></script>
@endsection
