<?php

namespace App\Observers;

use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuObserver
{
    /**
     * Handle the Menu "created" event.
     */
    public function created(Menu $menu)
    {
        $this->clearCache();
    }

    /**
     * Handle the Menu "updated" event.
     */
    public function updated(Menu $menu)
    {
        $this->clearCache();
    }

    /**
     * Handle the Menu "deleted" event.
     */
    public function deleted(Menu $menu)
    {
        $this->clearCache();
    }

    /**
     * Handle the Menu "restored" event.
     */
    public function restored(Menu $menu)
    {
        $this->clearCache();
    }

    /**
     * Handle the Menu "forceDeleted" event.
     */
    public function forceDeleted(Menu $menu)
    {
        $this->clearCache();
    }

    /**
     * Clear the menu cache.
     */
    protected function clearCache()
    {
        Cache::forget('menus');
    }
}
