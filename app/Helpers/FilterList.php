<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class FilterList {
    public static function export(Request $request, $ctrl = '', $customFilters = []){
        $ppEnum = Config::get('gds.perPage');
        $filters = array(
            "page"          => 1,
            "perPage"       => $ppEnum[0],
            "sortBy"        => 'main.id',
            "sortOrder"     => 'desc',
            "searchField"   => 'all',
            "searchValue"   => '',
        );
        if($customFilters) $filters = array_merge($filters, $customFilters);

        $params = $request->input();
        if(isset($params['clearSearch'])){
            $request->session()->put($ctrl, $filters);
        }else{
            foreach($filters as $k => $filter){
                $key = $ctrl.'.'.$k;
                if(!isset($params[$k])){
                    if(!$request->session()->has($key)){
                        $request->session()->put($key, $filter);
                    }
                }else{
                    if($k == 'perPage'){
                        $params[$k] = (in_array($params[$k], $ppEnum)) ? $params[$k] : $ppEnum[0];
                    }
                    $request->session()->put($key, $params[$k]);
                }
            }
        }

        return $request->session()->get($ctrl);
    }

    public static function checkClear(Request $request, $ctrl = 'home'){
        if($request->input('clearSearch')){
            $request->request->remove('clearSearch');
            return redirect()->route('admin.'.$ctrl)->send();
        }
        return true;
    }
}
