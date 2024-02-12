<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InserirLivros extends Migration
{
    public function up()
    {
        DB::table('livros')->insert([
            [
                'titulo' => 'Dom Quixote',
                'autor' => 'Miguel de Cervantes',
                'data_lancamento' => '1605-01-16',
                'genero' => 'Romance',
                'numero_paginas' => 863,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'O Pequeno Príncipe',
                'autor' => 'Antoine de Saint-Exupéry',
                'data_lancamento' => '1943-04-06',
                'genero' => 'Ficção',
                'numero_paginas' => 96,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Moby Dick',
                'autor' => 'Herman Melville',
                'data_lancamento' => '1851-10-18',
                'genero' => 'Ação',
                'numero_paginas' => 585,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Sherlock Holmes',
                'autor' => 'Arthur Conan Doyle',
                'data_lancamento' => '1892-10-14',
                'genero' => 'Mistério',
                'numero_paginas' => 1248,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Romeu e Julieta',
                'autor' => 'William Shakespeare',
                'data_lancamento' => '1597-01-20',
                'genero' => 'Romance',
                'numero_paginas' => 256,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        DB::table('livros')->truncate();
    }
}
