<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

trait ModuleControllerHelper
{
    protected $sessionKey;
    private $moduleName;
    private $table;
    private $pageTitle;
    private $routePrefix;
    private $pathView;
    private $pathViewTemplate;
    private $ctrl;

    public function initializeModuleController($moduleName, $pageTitle)
    {
        $this->pageTitle        = $pageTitle;
        $this->moduleName       = $moduleName;
        $this->table            = $moduleName.'s';
        $this->sessionKey       = $moduleName.'.';
        $this->routePrefix      = "admin.$moduleName.";
        $this->pathView         = "modules.$moduleName.";
        $this->pathViewTemplate = "templates.";
        $this->ctrl = Config::get("gds.route.$moduleName.ctrl");

        View::share([
            'ctrl' => $this->ctrl,
            'pathView' => $this->pathView,
            'pathViewTemplate' => $this->pathViewTemplate,
            'pageTitle' => $this->pageTitle,
            'routePrefix' => $this->routePrefix,
            'sessionKey' => $this->sessionKey
        ]);
    }

    // Remove all filter and sorting session data, then redirect back to the index route
    public function clear(Request $request)
    {
        // Clear the relevant session data
        $request->session()->forget(substr($this->sessionKey, 0, -1));

        // Redirect back to the index route
        return redirect()->route($this->routePrefix.'index');
    }
}
