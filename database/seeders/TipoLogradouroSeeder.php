<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoLogradouro;

class TipoLogradouroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoLogradouro::withoutEvents(function () {
            TipoLogradouro::insert([
                ['nome' => 'Rua'],
                ['nome' => 'Avenida'],
                ['nome' => 'Praça'],
            ]);
        });
    }
}
