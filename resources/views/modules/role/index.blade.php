@extends('elements.auth')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">

            @include($pathViewTemplate . 'page_header',
            [
                'title' => $pageTitle. ' management',
                'subTitle' => 'The '.$pageTitle. ' information list',
                'button' => (Auth::user()->can("create {$ctrl}s")) ? '<a href="'.route($routePrefix.'create').'" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Add New</a>' : ''
            ])

            @if ($errors->any() || session('notify'))
                <div class="m-3 mb-0">
                    @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                    @include($pathViewTemplate . 'error')
                </div>
            @endif

            <div class="card-body px-0 pb-0 pt-0">
                <div class="table-responsive">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-top">

                            <form method="GET" action="{{ route($routePrefix.'index') }}" id="filter-form">
                                <div class="d-flex justify-content-between">
                                    @include($pathViewTemplate.'per_page')
                                    <div class="d-flex">
                                        {{-- <div class="me-2">
                                            <x-search.filter :ctrl="$ctrl" :selected="session($ctrl . '.status')" :ruleName="'selectStatus'" :name="'status'" />
                                        </div> --}}
                                        <div class="me-0">
                                            <x-search.area :ctrl="$ctrl" :params="[session($ctrl . '.search_field', 'all'), session($ctrl . '.search_value')]" />
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                        @include($pathView.'list')

                        @include($pathViewTemplate.'pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
