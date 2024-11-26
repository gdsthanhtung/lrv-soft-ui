<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Config;
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

    public static function showItemStatus($ctrl, $id, $status, $withLink = true){
        $rule = Config::get('gds.enum.ruleStatus');
        $tpl = (isset($rule[$status])) ? $rule[$status] : $rule['unknown'];
        $link = ($withLink) ? route('admin.'.$ctrl.'.change-status', ['id' => $id, 'status' => $status]) : '#';
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

    public static function showListUL($data){
        $html = '';
        if($data) foreach ($data as $key => $item) {
            $html .= "<li>$item</li>";
        }
        $html = "<ul>$html</ul>";
        return $html;
    }
}
