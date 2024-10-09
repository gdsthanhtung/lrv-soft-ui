<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AdminBaseController extends Controller
{
    protected function handleFilters(
        $modelClass,
        Request $request,
        $sessionKey = '',
        $moduleName = '',
        array $filterFields,
        $defaultSortBy,
        $defaultSortOrder
    ) {
        $query = $modelClass::query();

        // Handle search
        $this->applySearch($request, $query, $moduleName, $sessionKey);

        // Handle filters
        $this->applyFilters($request, $query, $filterFields, $sessionKey);

        // Handle sorting
        $this->applySorting($request, $query, $defaultSortBy, $defaultSortOrder, $sessionKey);

        // Handle pagination parameters
        list($perPage, $page) = $this->getPaginationParams($request, $sessionKey);

        return [$query, $perPage, $page];
    }

    protected function applySearch(Request $request, $query, $moduleName, $sessionKey)
    {
        if (!$moduleName) return;

        // Fetch the configuration
        $searchFields = Config::get("gds.enum.selectionInModule." . $moduleName);

        // Filter out the 'all' element
        $searchFields = array_filter($searchFields, function ($field) {
            return $field !== 'all';
        });

        $searchValue = $request->input('search_value', session($sessionKey . 'search_value'));
        $searchField = $request->input('search_field', session($sessionKey . 'search_field'));

        if ($searchValue) {
            // Corrected the session call to store the correct values
            session([
                $sessionKey . 'search_field' => $searchField,
                $sessionKey . 'search_value' => $searchValue
            ]);

            $query->where(function ($q) use ($searchValue, $searchFields, $searchField) {
                if ($searchField == 'all') {
                    $q->whereAny($searchFields, 'like', '%' . $searchValue . '%');
                } else {
                    $q->where($searchField, 'like', '%' . $searchValue . '%');
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

    protected function applyDateFilters(Request $request, $query, $sessionKey, $fieldName = 'created_at')
    {
        if ($dateRange = $request->input('date_range_'.$fieldName)) {
            list($startDate, $endDate) = explode(' - ', $dateRange);
            session([$sessionKey . 'start_date' => $startDate]);
            session([$sessionKey . 'end_date' => $endDate]);
            $query->whereDate($fieldName, '>=', $startDate)
                  ->whereDate($fieldName, '<=', $endDate);
        } else {
            session()->forget([$sessionKey . 'start_date', $sessionKey . 'end_date']);
        }
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
