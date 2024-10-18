<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoleModel as MainModel;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest as MainRequest;
use App\Helpers\Notify;
use App\Http\Controllers\AdminBaseController;
use App\Traits\ModuleControllerHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

class RoleController extends AdminBaseController
{
    use ModuleControllerHelper;

    public function __construct()
    {
        $this->initializeModuleController('role', 'Role');
    }

    //=====================================================

    public function index(Request $request)
    {
        list($query, $perPage, $page) = $this->handleFilters(
            MainModel::class,
            $request,
            $this->sessionKey, // Session key prefix
            $this->moduleName, // Search fields like %%
            ['status'], // Filter fields equals
            'id', // Default sort by
            'desc', // Default sort order
        );

        // Apply date filters
        $this->applyDateFilters($request, $query, $this->sessionKey, 'created_at');

        $data = $query->with(['createdBy', 'updatedBy'])->paginate($perPage, ['*'], 'page', $page);

        return view($this->pathView.'index', compact('data'));
    }
}
