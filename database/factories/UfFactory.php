<?php

namespace Database\Factories;

use App\Models\Uf;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Uf>
 */
class UfFactory extends Factory
{
    protected $model = Uf::class;

    /**
     * @var array<int, string>
     */
    private const UFS = [
        'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO',
        'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI',
        'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO',
    ];

    /**
     * @return array<int, string>
     */
    public static function ufCodes(): array
    {
        return self::UFS;
    }

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'uf' => fake()->unique()->randomElement(self::UFS),
        ];
    }
}
