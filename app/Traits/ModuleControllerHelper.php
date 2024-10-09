<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

trait ModuleControllerHelper
{
    protected $sessionKey;
    private $moduleName;
    private $pageTitle;
    private $routePrefix;
    private $pathView;
    private $pathViewTemplate;
    private $ctrl;

    public function initializeModuleController($moduleName, $pageTitle)
    {
        $this->moduleName = $moduleName;
        $this->pageTitle = $pageTitle;
        $this->sessionKey = "$moduleName.";
        $this->routePrefix = "admin.$moduleName.";
        $this->pathView = "modules.$moduleName.";
        $this->pathViewTemplate = "templates.";
        $this->ctrl = Config::get("gds.route.$moduleName.ctrl");

        View::share([
            'ctrl' => $this->ctrl,
            'pathView' => $this->pathView,
            'pathViewTemplate' => $this->pathViewTemplate,
            'pageTitle' => $this->pageTitle,
            'routePrefix' => $this->routePrefix
        ]);
    }
}
