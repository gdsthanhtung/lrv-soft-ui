@php
    use App\Helpers\Template;
    $statusFilter = Template::showButtonFilter($ctrl, $countByStatus, $params);
    $searchArea = Template::showsearchArea($ctrl, $params);
@endphp

@extends('elements.auth')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="card">

            @include($pathViewTemplate . 'page-header',
            [
                'title' => $pageTitle,
                'button' => '<a href="'.route($ctrl."/form").'" class="btn bg-gradient-primary btn-sm mb-0"><i class="fa-solid fa-plus"></i> Add New</a>'
            ])

            <div class="m-3 mb-0">
                @includeWhen(session('notify'), $pathViewTemplate . 'notify')
                @include($pathViewTemplate . 'error')
            </div>

            <div class="card-body px-0 pb-0 pt-0">
                <div class="table-responsive">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-top">
                            <div class="dataTable-dropdown">
                                <label>
                                    Show
                                    <select class="dataTable-selector">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                    </select>
                                    entries
                                </label>
                            </div>

                            {!! $searchArea !!}
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
