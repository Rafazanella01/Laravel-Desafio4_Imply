<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use Illuminate\Support\Facades\Session;


class LivroController extends Controller
{
    public function listarLivros(Request $request)
    {
        $livros = Livro::query();

        if ($request->has('titulo')) {
            $livros->where('titulo', 'like', '%' . $request->titulo . '%');
        }
        if ($request->has('genero')) {
            $livros->where('genero', $request->genero);
        }
        if ($request->has('autor')) {
            $livros->where('autor', 'like', '%' . $request->autor . '%');
        }
        if ($request->has('data_inicial')) {
            $livros->whereDate('created_at', '>=', $request->data_inicial);
        }
        if ($request->has('data_final')) {
            $livros->whereDate('created_at', '<=', $request->data_final);
        }
        $livros = $livros->get()->map(function ($livro) {
            $data_lancamento_formatada = date('Y-m-d', strtotime($livro->data_lancamento));
            return [
                'id' => $livro->id,
                'titulo' => $livro->titulo,
                'autor' => $livro->autor,
                'data_lancamento' => $data_lancamento_formatada,
                'genero' => $livro->genero,
                'numero_paginas' => $livro->numero_paginas,
                'created_at' => date('Y-m-d H:i:s', strtotime($livro->created_at)),
                'updated_at' => date('Y-m-d H:i:s', strtotime($livro->updated_at)),
            ];
        });
        
        return response()->json($livros, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function criarLivro(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string',
            'autor' => 'required|string',
            'data_lancamento' => 'required|date',
            'genero' => 'required|in:Romance,Clássico,Ficção,Mistério,Ação,Drama',
            'numero_paginas' => 'required|integer|min:1'
        ]);

        $livro = Livro::create($request->all());

        return response()->json($livro, 201);
    }

    public function mostrarLivro($id)
    {
        $livro = Livro::findOrFail($id);

        return response()->json($livro, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function atualizarLivro(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'string',
            'autor' => 'string',
            'data_lancamento' => 'date',
            'genero' => 'in:Romance,Clássico,Ficção,Mistério,Ação,Drama',
            'numero_paginas' => 'integer|min:1'
        ]);

        $livro = Livro::findOrFail($id);
        $livro->update($request->all());

        return response()->json($livro, 200);
    }

    public function deletarLivro($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();

        Session::flash('mensagem', 'Item deletado com sucesso.');

        return response()->json(null, 204);
        return redirect()->back();
    }
}

?>