<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyService
{
    /**
     * Fetch all companies.
     */
    public function fetchAll(?string $search, bool $usePagination = false, ?int $perPage): Collection|LengthAwarePaginator
    {
        $query = Company::with('tasks')
            ->when($search, fn ($query) => 
                $query->where('name', 'like', "%{$search}%")
            );

        if ($usePagination) {
            return $query->paginate(
                perPage: $perPage ?? 10,
            );
        }

        return $query->get();
    }
}