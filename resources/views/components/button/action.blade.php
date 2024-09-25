@php
    $rule = Config::get('gds.enum.ruleBtn');
    $btnInArea = Config::get('gds.enum.btnInArea');

    $ctrl = (array_key_exists($ctrl, $btnInArea)) ? $ctrl : 'default';
    $listBtn = $btnInArea[$ctrl];
    $html = "";

    foreach($listBtn as $item){
        $button = $rule[$item];
        $link = route('admin.'.$ctrl.$button['route'], ['id' => $id]);
        $html .= sprintf('<a href="%s" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="%s">
                            <i class="fa %s text-secondary" aria-hidden="true"></i>
                        </a>', $link, $button['title'], $button['icon']);
    }
    $html = '<div class="zvn-box-btn-filter">'.$html.'</div>';
@endphp

{!! $html !!}
