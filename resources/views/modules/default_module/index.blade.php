@php
    use App\Helpers\Template;
    //$statusFilter = Template::showButtonFilter($ctrl, $countByStatus, $params);
    //$statusFilter = Template::showDropdownFilter($ctrl, $params, $enum = 'ruleStatus', $class = 'secondary', $filterName = 'status');
    //$searchArea = Template::showsearchArea($ctrl, $params);
@endphp

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
                            {{-- <x-button.filter :ctrl="$ctrl" :countByStatus="$countByStatus" :params="$params" />
                            <x-search.area :ctrl="$ctrl" :params="$params" /> --}}
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
