<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    public function handle(Request $request, Closure $next, $resource)
    {
        $actions = [
            'index'     => "view $resource",
            'show'      => "view $resource",
            'create'    => "create $resource",
            'store'     => "create $resource",
            'edit'      => "edit $resource",
            'update'    => "edit $resource",
            'destroy'   => "delete $resource",
        ];

        foreach ($actions as $action => $permission) {
            if ($request->route()->getActionMethod() === $action) {
                // Check for resource-based permission
                if (Auth::user()->can($permission)) {
                    return $next($request);
                }

                // Check for direct permission
                if (Auth::user()->hasPermissionTo($permission)) {
                    return $next($request);
                }

                // If neither permission is granted, abort with 403
                abort(403, 'User does not have the right permissions.');
            }
        }

        return $next($request);
    }
}
