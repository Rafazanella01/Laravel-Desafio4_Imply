<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InserirLivros extends Migration
{
    public function up()
    {

        //date_default_timezone_set('America/Sao_Paulo');

        DB::table('livros')->insert([
            [
                'titulo' => 'Dom Quixote',
                'autor' => 'Miguel de Cervantes',
                'dataLancamento' => '1605-01-16',
                'genero' => 'Romance',
                'numeroPaginas' => 863,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'O Pequeno Príncipe',
                'autor' => 'Antoine de Saint-Exupéry',
                'dataLancamento' => '1943-04-06',
                'genero' => 'Ficção',
                'numeroPaginas' => 96,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Moby Dick',
                'autor' => 'Herman Melville',
                'dataLancamento' => '1851-10-18',
                'genero' => 'Ação',
                'numeroPaginas' => 585,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Sherlock Holmes',
                'autor' => 'Arthur Conan Doyle',
                'dataLancamento' => '1892-10-14',
                'genero' => 'Mistério',
                'numeroPaginas' => 1248,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Romeu e Julieta',
                'autor' => 'William Shakespeare',
                'dataLancamento' => '1597-01-20',
                'genero' => 'Romance',
                'numeroPaginas' => 256,
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
