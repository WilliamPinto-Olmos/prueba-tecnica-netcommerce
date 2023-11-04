<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchCompaniesRequest;
use App\Http\Resources\CompanyResource;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class FetchCompaniesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FetchCompaniesRequest $request, CompanyService $companyService)
    {
        $companies = $companyService->fetchAll($request->search, usePagination: $request->has('page'), perPage: $request->per_page);

        return CompanyResource::collection($companies);
    }
}
