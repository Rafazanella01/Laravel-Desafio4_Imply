<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
class LivroController extends Controller
{
    public function listarLivros(Request $request)
    {
        try{
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
            if ($request->has('dataInicial') && $request->has('dataFinal')) {
                $dataInicial = $request->dataInicial;
                $dataFinal = $request->dataFinal;
                $livros->whereBetween('dataLancamento', [$dataInicial, $dataFinal]);
            }
            
            $livros = $livros->get();

            if ($livros->isEmpty()) {
                return response()->json(['message' => 'Não há livros para listar.'], 404);
            }

            $livros = $livros->map(function ($livro) {
                return [
                    'id' => $livro->id,
                    'titulo' => $livro->titulo,
                    'autor' => $livro->autor,
                    'dataLancamento' =>  $livro->dataLancamento, 
                    'genero' => $livro->genero,
                    'numeroPaginas' => $livro->numeroPaginas,
                    'created_at' => date('Y-m-d H:i:s', strtotime($livro->created_at)),
                    'updated_at' => date('Y-m-d H:i:s', strtotime($livro->updated_at)),
                ];
            });
            
            return response()->json($livros, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        }catch(\Exception $e){
        return response()->json(['error' => 'Ocorreu um erro ao listar os livros: ' . $e->getMessage()], 500);
        }
    }

    public function criarLivro(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|string',
                'autor' => 'required|string',
                'dataLancamento' => 'required|date',
                'genero' => 'required|in:Romance,Clássico,Ficção,Mistério,Ação,Drama',
                'numeroPaginas' => 'required|integer|min:1'
            ]);

            $livro = Livro::create($request->all());

            return response()->json($livro, 201);

         } catch (\Exception $e) {
         return response()->json(['error' => 'Ocorreu um erro ao criar o livro: ' . $e->getMessage()], 500);
         }
    }

    public function mostrarLivro($id)
    {
        try{

            $livro = Livro::findOrFail($id);

            return response()->json($livro, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
        return response()->json(['error' => 'O livro não pôde ser encontrado: ' . $e->getMessage()], 404);
        }
    }

    public function atualizarLivro(Request $request, $id)
    {
        try{
            $request->validate([
                'titulo' => 'string',
                'autor' => 'string',
                'dataLancamento' => 'date',
                'genero' => 'in:Romance,Clássico,Ficção,Mistério,Ação,Drama',
                'numeroPaginas' => 'integer|min:1'
            ]);

            $livro = Livro::findOrFail($id);
            $livro->update($request->all());

            return response()->json($livro, 200);

        } catch (\Exception $e) {
        return response()->json(['error' => 'Ocorreu um erro ao atualizar o livro: ' . $e->getMessage()], 500);
        }
    }

    public function deletarLivro($id)
    {
        try{
            $livro = Livro::findOrFail($id);
            $livro->delete();

            return response()->json(null, 204);

        } catch (\Exception $e) {
        return response()->json(['error' => 'Ocorreu um erro ao excluir o livro: ' . $e->getMessage()], 500);
        }
    }
}

?>