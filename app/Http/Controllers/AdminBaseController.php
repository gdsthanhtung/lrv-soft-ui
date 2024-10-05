<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminBaseController extends Controller
{
    protected function handleFilters(
        $modelClass,
        Request $request,
        $sessionKey = '',
        array $searchFields,
        array $filterFields,
        $defaultSortBy,
        $defaultSortOrder
    ) {
        $query = $modelClass::query();

        // Handle search
        $this->applySearch($request, $query, $searchFields, $sessionKey);

        // Handle filters
        $this->applyFilters($request, $query, $filterFields, $sessionKey);

        // Handle sorting
        $this->applySorting($request, $query, $defaultSortBy, $defaultSortOrder, $sessionKey);

        // Handle pagination parameters
        list($perPage, $page) = $this->getPaginationParams($request, $sessionKey);

        return [$query, $perPage, $page];
    }

    protected function applySearch(Request $request, $query, array $searchFields, $sessionKey)
    {
        if ($search = $request->input('search', session($sessionKey . 'search'))) {
            session([$sessionKey . 'search' => $search]);
            $query->where(function ($q) use ($search, $searchFields) {
                foreach ($searchFields as $field) {
                    $q->orWhere($field, 'like', '%' . $search . '%');
                }
            });
        }
    }

    protected function applyFilters(Request $request, $query, array $filterFields, $sessionKey)
    {
        foreach ($filterFields as $field) {
            if ($value = $request->input($field, session($sessionKey . $field))) {
                session([$sessionKey . $field => $value]);
                $query->where($field, $value);
            }
        }
    }

    protected function applySorting(Request $request, $query, $defaultSortBy, $defaultSortOrder, $sessionKey)
    {
        $sortBy = $request->input('sort_by', session($sessionKey . 'sort_by', $defaultSortBy));
        $sortOrder = $request->input('sort_order', session($sessionKey . 'sort_order', $defaultSortOrder));
        session([$sessionKey . 'sort_by' => $sortBy, $sessionKey . 'sort_order' => $sortOrder]);
        $query->orderBy($sortBy, $sortOrder);
    }

    protected function getPaginationParams(Request $request, $sessionKey)
    {
        $perPage = $request->input('per_page', session($sessionKey . 'per_page', 10));
        session([$sessionKey . 'per_page' => $perPage]);
        $page = $request->input('page', session($sessionKey . 'page', 1));
        session([$sessionKey . 'page' => $page]);

        return [$perPage, $page];
    }
}
