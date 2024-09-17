<?php
namespace App\Helpers;
use Config;
use Carbon\Carbon;

class Template {
    public static function showNum($data, $currency = false){
        $c = ($currency) ? ' đ' : '';
        return number_format($data, 0, ',', '.').$c;
    }

    public static function showDate($date, $compareToday = false, $separator = false){
        $d = sprintf ("%s", date(Config::get('gds.format.shortTime'), strtotime($date)));
        if($compareToday == false){
            if($separator) $d = str_replace('-', $separator, $d);
            return $d;
        }else{
            if($separator) $d = str_replace('-', $separator, $d);
            $rs = (strtotime($date) >= strtotime(Carbon::now())) ? $d : '<span class="badge badge-danger">'.$d.'</span>';
            return $rs;
        }
    }

    public static function showDateDKTT($date, $compareMonthAgo = 0){
        $d = sprintf ("%s", date(Config::get('gds.format.shortTime'), strtotime($date)));
        $rs = (strtotime(Carbon::now()) >= strtotime(Carbon::parse($date)->subMonth($compareMonthAgo))) ? '<span class="badge badge-danger">'.$d.'</span>' : $d;
        return $rs;
    }

    public static function showItemHistory($by, $time, $type){
        $tooltips = ucfirst($type);
        return sprintf ("
            <span class='text-secondary' data-bs-toggle='tooltip' data-bs-original-title='%s'><small><i class='fas fa-user'></i> %s <br> <i class='fas fa-clock'></i> %s </small></span>
        ", $tooltips, $by, date(Config::get('gds.format.shortTime'), strtotime($time)));
    }

    public static function showItemStatus($ctrl, $id, $status){
        $rule = Config::get('gds.enum.ruleStatus');
        $tpl = (isset($rule[$status])) ? $rule[$status] : $rule['unknown'];
        $link = route($ctrl.'/change-status', ['id' => $id, 'status' => $status]);
        return sprintf ("<a href='%s' type='button' class='btn btn-sm mb-0 bg-gradient-%s'>%s</a>", $link, $tpl['class'], $tpl['name']);
    }

    public static function showItemStatusHoaDon($ctrl, $id, $status){
        $rule = Config::get('gds.enum.ruleStatusHoaDon');
        $tpl = (isset($rule[$status])) ? $rule[$status] : $rule['unknown'];
        $link = route($ctrl.'/change-status', ['id' => $id, 'status' => $status]);
        return sprintf ("<a href='%s' type='button' class='btn btn-sm mb-0 bg-gradient-%s'>%s</a>", $link, $tpl['class'], $tpl['name']);
    }

    public static function showItemThumb($ctrl, $img, $alt){
        return sprintf (" <img src=%s }} alt=%s class='thumb'> ", asset("images/$ctrl/$img"), $alt);
    }

    public static function showItemCCCD($ctrl, $img, $alt){
        return sprintf (" <img src=%s }} alt=%s class='cccd'> ", asset("images/$ctrl/$img"), $alt);
    }

    public static function showItemAvatar($ctrl, $img, $alt, $size = 'xxl'){
        return sprintf ("<img src='%s' alt='%s' class='avatar avatar-%s shadow'>", asset("images/$ctrl/$img"), $alt, $size);
    }

    public static function showActionButton($ctrl, $id){
        $rule = Config::get('gds.enum.ruleBtn');

        $btnInArea = Config::get('gds.enum.btnInArea');

        $ctrl = (array_key_exists($ctrl, $btnInArea)) ? $ctrl : 'default';
        $listBtn = $btnInArea[$ctrl];
        $html = "";

        foreach($listBtn as $item){
            $button = $rule[$item];
            $link = route($ctrl.$button['route'], ['id' => $id]);
            $html .= sprintf('<a href="%s" class="mx-2" data-bs-toggle="tooltip" data-bs-original-title="%s">
                                <i class="fa %s text-secondary" aria-hidden="true"></i>
                            </a>', $link, $button['title'], $button['icon']);
        }
        $html = '<div class="zvn-box-btn-filter">'.$html.'</div>';
        return $html;
    }

    public static function showButtonFilter($ctrl, $countByStatus, $params, $enum = 'ruleStatus'){
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

                $link = route($ctrl).'?status='.$status.$searchField.$searchValue;
                $class = ($params['filter']['status'] == $status) ? $tpl['class'] : 'secondary';
                $html .= sprintf('<a href="%s" type="button" class="btn btn-%s md-2 mr-5">%s <span class="badge bg-white text-%s">%s</span></a>',
                                    $link, $class, ucfirst($tpl['name']), $class, $item['total']);
            }
        }
        return $html;
    }

    public static function showSearchArea($ctrl, $params, $searchSelection = 'searchSelection'){
        $html = "";

        extract($params);
        $searchValue = $filter['searchValue'];
        $ctrl = (isset($selectionInModule[$ctrl]))  ? $ctrl : 'default';

        $html = sprintf('<div class="dataTable-search">
                            <input class="dataTable-input" placeholder="Search..." type="text" name="searchValue" value="%s">
                        </div>', $searchValue);

        return $html;
    }

    public static function showItemSelect($ctrl, $id, $displayValue, $fieldName)
    {
       $link = route($ctrl . '/change-' . $fieldName, [$fieldName => 'value_new', 'id' => $id]);

       $tmplDisplay = Config::get('gds.enum.select' . ucfirst($fieldName));
       $html = sprintf('<select name="selectChangeAttr" data-url="%s" class="form-select">', $link  );

        foreach ($tmplDisplay as $key => $value) {
           $htmlSelected = '';
           if ($key == $displayValue) $htmlSelected = 'selected="selected"';
            $html .= sprintf('<option value="%s" %s>%s</option>', $key, $htmlSelected, $value);
        }
        $html .= '</select>';

        return $html;
    }

    public static function showItemDropdown($ctrl, $id, $displayValue, $fieldName)
    {
        $html = $list = '';
        $enum = Config::get('gds.enum.select' . ucfirst($fieldName));

        foreach ($enum['value'] as $key => $value) {
            $link = route($ctrl . '/change-' . $fieldName, [$fieldName => $key, 'id' => $id]);
            $list .= sprintf('<li><a class="dropdown-item" href="%s">%s</a></li>', $link, $value);
        }

        $class = isset($enum['class'][$displayValue]) ? $enum['class'][$displayValue] : 'secondary';
        $value = isset($enum['value'][$displayValue]) ? $enum['value'][$displayValue] : 'N/A';

        $html = sprintf('
            <div class="dropdown">
                <button class="btn bg-gradient-%s btn-sm dropdown-toggle mb-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    %s
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    %s
                </ul>
            </div>
        ', $class, $value, $list);

        return $html;
    }

    public static function radioSelect($listToSelect = [], $elName = 'noname', $valToChecked = null){
        $html = '';
        foreach ($listToSelect as $value => $title) {
            $checked = ($value === $valToChecked) ? 'checked' : '';
            $html .= "<div class='form-check form-check-inline'>
                        <input class='form-check-input' type='radio' name='$elName' id='$elName$value' value='$value' $checked>
                        <label class='form-check-label' for='$elName$value'>$title</label>
                    </div>";
        }
        return $html;
    }

    public static function buildNhanKhauInHopDong($id, $nkInHopDong = []){
        $mqhEnum = Config::get('gds.enum.mqh');
        $nkIdOptionSelected = [];
        $nkNameOptionSelected = [];
        $mqhIdOptionSelected = [];
        $mqhNameOptionSelected = [];
        $initNkSelected = '';
        if($nkInHopDong){
            foreach($nkInHopDong[$id] as $nk){
                $nkInfo = $nk['name'].' - '.$nk['cccd_number'].' - '.$nk['status'];
                $initNkSelected .= '<div class="alert alert-info alert-dismissible fade show init-nk-selected" role="alert">';
                $initNkSelected .= '<button type="button" class="btn-close remove-cong-dan" cong-dan-id="'.$nk['cong_dan_id'].'" data-bs-dismiss="alert" aria-label="Close"></button>';
                $initNkSelected .= $nk['name'].' - '.$nk['cccd_number'].' - '.$nk['status'].' <strong> ('.$mqhEnum[$nk['mqh_chu_phong']].') </strong>';
                $initNkSelected .= '</div>';
                $nkIdOptionSelected[]       = (string)$nk['cong_dan_id'];
                $nkNameOptionSelected[]     = $nkInfo;
                $mqhIdOptionSelected[]      = (string)$nk['mqh_chu_phong'];
                $mqhNameOptionSelected[]    = $mqhEnum[$nk['mqh_chu_phong']];
            }
        }else{
            $initNkSelected = '<div class="alert alert-warning alert-dismissible fade show init-nk-selected" role="alert"><i class="bi bi-info-circle me-1"></i>Chọn nhân khẩu từ danh sách phía trên!</div>';
        }
        return [
            'initNkSelected'        => $initNkSelected,
            'nkIdOptionSelected'    => $nkIdOptionSelected,
            'nkNameOptionSelected'  => $nkNameOptionSelected,
            'mqhIdOptionSelected'   => $mqhIdOptionSelected,
            'mqhNameOptionSelected' => $mqhNameOptionSelected,
        ];
    }

    public static function buildSelectCongDanList($dataCongDan = [], $nkIdOptionSelected){
        $selectCongDanList = '<select class="form-control col-7" id="cong_dan_list" name="cong_dan_list"><option value="">Select an item...</option>';
        if($dataCongDan) foreach ($dataCongDan as $cdId => $cd) {
            $disable = (in_array($cdId, $nkIdOptionSelected)) ? 'disabled="disabled" class="selected-option"' : '';
            $selectCongDanList .= "<option $disable value='$cdId'>$cd</option>";
        }
        $selectCongDanList .= '</select>';
        return $selectCongDanList;
    }

    public static function ct01($cdId, $task = 'NEW', $withFamify = false){
        $text = ($cdId == 'ALL') ? "$cdId-CT01-$task" : "CT01-$task";
        $class = ($task == 'NEW') ? 'primary' : 'warning';
        return "<a href=".route('congdan/ct01', ['id' => $cdId, 'task' => $task, 'withFamily' => $withFamify])." target='_blank' class='btn btn-$class btn-sm mb-1 mr-5'>$text</a>";
    }

    public static function hdtn($id, $task = 'hdtn'){
        $date = Carbon::now()->format('d/m/Y');
        if($task == 'hdtn'){
            $class = 'success';
            $text = 'HĐ Thuê Nhà';
        }else{
            $class = 'warning';
            $text = 'HĐ Thuê Nhà';
        }
        return "<a href=".route('hopdong/export', ['id' => $id, 'task' => $task, 'thoiHanONho' => 24, 'thoiHanTuNgay' => $date])." target='_blank' class='btn btn-$class btn-sm mb-1 mr-5'>$text</a>";
    }
}
