<?php
namespace App\Helpers;
use Config;

class Highlight {
    public static function show($ctrl, $data){
        $searchValue = session($ctrl.'.search_value');
        if($searchValue){
            return preg_replace("/".preg_quote($searchValue, "/")."/iu", "<mark class='bg-gradient-warning'>$0</mark>", $data);
        } else {
            return $data;
        }
    }
}
