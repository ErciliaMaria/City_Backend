<?php

namespace Database\Factories;

use App\Models\Cidade;
use App\Models\Uf;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Cidade>
 */
class CidadeFactory extends Factory
{
    protected $model = Cidade::class;

    /**
     * @var array<string, array<int, array{nome: string, ddd: int}>>
     */
    private const CIDADES_POR_UF = [
        'AC' => [['nome' => 'Rio Branco', 'ddd' => 68], ['nome' => 'Cruzeiro do Sul', 'ddd' => 68]],
        'AL' => [['nome' => 'Maceio', 'ddd' => 82], ['nome' => 'Arapiraca', 'ddd' => 82]],
        'AP' => [['nome' => 'Macapa', 'ddd' => 96], ['nome' => 'Santana', 'ddd' => 96]],
        'AM' => [['nome' => 'Manaus', 'ddd' => 92], ['nome' => 'Parintins', 'ddd' => 92]],
        'BA' => [['nome' => 'Salvador', 'ddd' => 71], ['nome' => 'Feira de Santana', 'ddd' => 75]],
        'CE' => [['nome' => 'Fortaleza', 'ddd' => 85], ['nome' => 'Juazeiro do Norte', 'ddd' => 88]],
        'DF' => [['nome' => 'Brasilia', 'ddd' => 61], ['nome' => 'Taguatinga', 'ddd' => 61]],
        'ES' => [['nome' => 'Vitoria', 'ddd' => 27], ['nome' => 'Vila Velha', 'ddd' => 27]],
        'GO' => [['nome' => 'Goiania', 'ddd' => 62], ['nome' => 'Anapolis', 'ddd' => 62]],
        'MA' => [['nome' => 'Sao Luis', 'ddd' => 98], ['nome' => 'Imperatriz', 'ddd' => 99]],
        'MT' => [['nome' => 'Cuiaba', 'ddd' => 65], ['nome' => 'Rondonopolis', 'ddd' => 66]],
        'MS' => [['nome' => 'Campo Grande', 'ddd' => 67], ['nome' => 'Dourados', 'ddd' => 67]],
        'MG' => [['nome' => 'Belo Horizonte', 'ddd' => 31], ['nome' => 'Uberlandia', 'ddd' => 34]],
        'PA' => [['nome' => 'Belem', 'ddd' => 91], ['nome' => 'Santarem', 'ddd' => 93]],
        'PB' => [['nome' => 'Joao Pessoa', 'ddd' => 83], ['nome' => 'Campina Grande', 'ddd' => 83]],
        'PR' => [['nome' => 'Curitiba', 'ddd' => 41], ['nome' => 'Londrina', 'ddd' => 43]],
        'PE' => [['nome' => 'Recife', 'ddd' => 81], ['nome' => 'Caruaru', 'ddd' => 81]],
        'PI' => [['nome' => 'Teresina', 'ddd' => 86], ['nome' => 'Parnaiba', 'ddd' => 86]],
        'RJ' => [['nome' => 'Rio de Janeiro', 'ddd' => 21], ['nome' => 'Niteroi', 'ddd' => 21]],
        'RN' => [['nome' => 'Natal', 'ddd' => 84], ['nome' => 'Mossoro', 'ddd' => 84]],
        'RS' => [['nome' => 'Porto Alegre', 'ddd' => 51], ['nome' => 'Caxias do Sul', 'ddd' => 54]],
        'RO' => [['nome' => 'Porto Velho', 'ddd' => 69], ['nome' => 'Ji-Parana', 'ddd' => 69]],
        'RR' => [['nome' => 'Boa Vista', 'ddd' => 95], ['nome' => 'Rorainopolis', 'ddd' => 95]],
        'SC' => [['nome' => 'Florianopolis', 'ddd' => 48], ['nome' => 'Joinville', 'ddd' => 47]],
        'SP' => [['nome' => 'Sao Paulo', 'ddd' => 11], ['nome' => 'Campinas', 'ddd' => 19]],
        'SE' => [['nome' => 'Aracaju', 'ddd' => 79], ['nome' => 'Itabaiana', 'ddd' => 79]],
        'TO' => [['nome' => 'Palmas', 'ddd' => 63], ['nome' => 'Araguaina', 'ddd' => 63]],
    ];

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'uf_id' => Uf::factory(),
            'nome' => fake()->city(),
            'cep' => fake()->optional()->numerify('#####-###'),
            'ddd' => fake()->optional()->numberBetween(11, 99),
            'codigo_ibge' => fake()->optional()->numerify('#######'),
        ];
    }

    public function forUf(Uf $uf): static
    {
        return $this->state(function () use ($uf): array {
            $opcoes = self::CIDADES_POR_UF[$uf->uf] ?? [['nome' => fake()->city(), 'ddd' => fake()->numberBetween(11, 99)]];
            $cidade = fake()->randomElement($opcoes);

            return [
                'uf_id' => $uf->id,
                'nome' => $cidade['nome'],
                'ddd' => $cidade['ddd'],
                'cep' => fake()->optional()->numerify('#####-###'),
                'codigo_ibge' => fake()->optional()->numerify('#######'),
            ];
        });
    }
}
