<?php

namespace App\Repositories\City;

use App\Contracts\City\Repository\ListCityRepositoryInterface;
use App\Models\Cidade;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListCityRepository implements ListCityRepositoryInterface
{
    public function execute(int $page, int $limit, string $search): LengthAwarePaginator
    {
        $query = Cidade::query()->with('uf');

        if ($search !== '') {
            $query->where('nome', 'like', '%' . $search . '%');
        }

        return $query
            ->orderBy('nome')
            ->paginate(perPage: $limit, page: $page);
    }
}
