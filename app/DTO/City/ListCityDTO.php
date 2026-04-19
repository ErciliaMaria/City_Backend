<?php

namespace App\DTO\City;

class ListCityDTO
{
  public function __construct(
    public string $page,
    public string $limit,
    public string $search
  ){}

  public static function fromRequest(array $data): self
  {
    return new self(
        page: $data['page'] ?? 1,
        limit: $data['limit'] ?? 10,
        search: $data['search'] ?? ''
    );
  }
}
