<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cidade;
class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cidade::withoutEvents(function () {
            Cidade::insert([
                ['nome' => 'Belo Horizonte'],
                ['nome' => 'Betim'],
                ['nome' => 'Contagem'],
            ]);
        });
    }
}
