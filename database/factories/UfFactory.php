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
     * @var array<string, string>
     */
    private const UF_STATES = [
        'AC' => 'Acre',
        'AL' => 'Alagoas',
        'AP' => 'Amapa',
        'AM' => 'Amazonas',
        'BA' => 'Bahia',
        'CE' => 'Ceara',
        'DF' => 'Distrito Federal',
        'ES' => 'Espirito Santo',
        'GO' => 'Goias',
        'MA' => 'Maranhao',
        'MT' => 'Mato Grosso',
        'MS' => 'Mato Grosso do Sul',
        'MG' => 'Minas Gerais',
        'PA' => 'Para',
        'PB' => 'Paraiba',
        'PR' => 'Parana',
        'PE' => 'Pernambuco',
        'PI' => 'Piaui',
        'RJ' => 'Rio de Janeiro',
        'RN' => 'Rio Grande do Norte',
        'RS' => 'Rio Grande do Sul',
        'RO' => 'Rondonia',
        'RR' => 'Roraima',
        'SC' => 'Santa Catarina',
        'SP' => 'Sao Paulo',
        'SE' => 'Sergipe',
        'TO' => 'Tocantins',
    ];

    /**
     * @return array<int, string>
     */
    public static function ufCodes(): array
    {
        return array_keys(self::UF_STATES);
    }

    /**
     * @return array<string, string>
     */
    public static function ufStates(): array
    {
        return self::UF_STATES;
    }

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uf = fake()->randomElement(array_keys(self::UF_STATES));

        return [
            'id' => (string) Str::uuid(),
            'estado' => self::UF_STATES[$uf],
            'uf' => $uf,
        ];
    }
}
