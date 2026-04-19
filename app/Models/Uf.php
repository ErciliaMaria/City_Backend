<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Uf extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    public function cidades(): HasMany
    {
        return $this->hasMany(Cidade::class);
    }
}
