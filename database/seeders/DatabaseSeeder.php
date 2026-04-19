<?php

namespace Database\Seeders;

use App\Models\Cidade;
use App\Models\Uf;
use App\Models\User;
use Database\Factories\UfFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $ufs = collect(UfFactory::ufCodes())
            ->map(fn (string $siglaUf) => Uf::factory()->create([
                'uf' => $siglaUf,
            ]));

        $ufs->each(function (Uf $uf): void {
            Cidade::factory()
                ->count(8)
                ->forUf($uf)
                ->create();
        });

        if (Schema::hasTable('users')) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
    }
}
