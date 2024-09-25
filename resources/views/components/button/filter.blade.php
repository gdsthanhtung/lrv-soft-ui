@php
    $html = "";
    $rule = Config::get('gds.enum.'.$enum);

    $searchValue    = ($params["filter"]['searchValue']) ? '&searchValue='.$params["filter"]['searchValue'] : '';
    $searchField    = ($params["filter"]['searchValue']) ? '&searchField='.$params["filter"]['searchField'] : '';

    if($countByStatus) {
        array_unshift($countByStatus, [
            'total' => array_sum(array_column($countByStatus, 'total')),
            'status' => 'all'
        ]);
        foreach($countByStatus as $item){
            $status = $item['status'];
            $tpl = (isset($rule[$status])) ? $rule[$status] : $rule['unknown'];

            $link = route('admin.'.$ctrl).'?status='.$status.$searchField.$searchValue;
            $class = ($params['filter']['status'] == $status) ? $tpl['class'] : 'secondary';
            $html .= sprintf('<a href="%s" type="button" class="btn bg-gradient-%s btn-sm me-1">%s <span class="badge bg-white text-%s">%s</span></a>',
                                $link, $class, ucfirst($tpl['name']), $class, $item['total']);
        }
    }
@endphp

{!! $html !!}
