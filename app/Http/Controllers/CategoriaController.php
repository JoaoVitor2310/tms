<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::with('user')
            ->where('user_id', Auth::id())
            ->when($request->nome, function ($query, $nome) {
                $query->where('nome', 'like', "%{$nome}%");
            })
            ->when($request->data_inicial, function ($query, $dataInicial) {
                $query->whereDate('created_at', '>=', $dataInicial);
            })
            ->when($request->data_final, function ($query, $dataFinal) {
                $query->whereDate('created_at', '<=', $dataFinal);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.categoria_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        try {
            Categoria::create([
                'nome' => $data['nome'],
                'user_id' => Auth::id(),
            ]);

            return redirect()
                ->route('categorias.index')
                ->with('success_message', 'Categoria criada com sucesso!');
        } catch (QueryException $e) {
            // Loga o erro para desenvolvedores
            Log::error('Erro ao criar categoria: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error_message', 'Ocorreu um erro ao criar a categoria. Tente novamente.');
            // ->with('error_message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$categoria) {
            return redirect()
                ->route('categorias.index')
                ->with('error_message', 'Categoria não encontrada ou não pertence a você.');
        }

        return view('categorias.categoria_form', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255', // Adicione outras validações conforme necessário
        ]);

        $categoria = Categoria::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        // Verifica se o usuário não existe
        if (!$categoria) {
            return redirect()->route('categorias.index')->with('error_message', 'Categoria não encontrada.');
        }

        $data = $request->only(['nome']);

        $categoria->update($data);

        return redirect()->route('categorias.index')->with('success_message', 'Categoria alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$categoria) {
            return redirect()
                ->route('categorias.index')
                ->with('error_message', 'Categoria não encontrada ou não pertence a você.');
        }

        try {
            $categoria->delete();

            return redirect()
                ->route('categorias.index')
                ->with('success_message', 'Categoria excluída com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir categoria: ' . $e->getMessage());

            return redirect()
                ->route('categorias.index')
                ->with('error_message', 'Erro ao excluir categoria. Tente novamente.');
        }
    }
}
