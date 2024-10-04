<?php
namespace App\Helpers;
use Config;

class Highlight {
    public static function show($data, $search, $field){
        if(isset($search['searchValue']) && $search['searchValue']){
            if($search['searchField'] == "all" || $search['searchField'] == $field) {
                return preg_replace("/".preg_quote($search['searchValue'], "/")."/iu", "<mark class='bg-gradient-warning'>$0</mark>", $data);
            }
            return $data;
        } else {
            return $data;
        }
    }
}
