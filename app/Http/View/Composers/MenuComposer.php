<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuComposer
{
    /**
     * Cache key and duration.
     */
    protected $cacheKey = 'menus';
    protected $cacheDuration;

    public function __construct()
    {
        $this->cacheDuration = config('env.MENU_CACHE_DURATION', 60); // default to 60 minutes if not set
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $useCache = true;

        if ($useCache) {
            $menus = Cache::remember($this->cacheKey, $this->cacheDuration, function () {
                return $this->getMenuFromDB();
            });
        } else {
            $menus = $this->getMenuFromDB();
        }


        $view->with('menus', $menus);
    }

    public function getMenuFromDB()
    {
        return Menu::where('status', 'active')
                    ->whereNull('parent_id')
                    ->orderBy('order')
                    ->with(['children' => function ($query) {
                        $query->where('status', 'active')->orderBy('order');
                    }])
                    ->get();
    }
}
