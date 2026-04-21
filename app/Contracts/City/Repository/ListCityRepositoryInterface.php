<?php

namespace App\Contracts\City\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ListCityRepositoryInterface
{
    public function execute(int $page, int $limit, string $search): LengthAwarePaginator;
}
