<?php

namespace App\Http\Controllers;

use App\Models\Anotacao;
use App\Models\Categoria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnotacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anotacoes = Anotacao::with('categoria', 'user')->where('user_id', Auth::id())->get();
        return view('anotacoes.index', compact('anotacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('anotacoes.anotacao_form', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        try {
            Anotacao::create([
                'titulo' => $data['titulo'],
                'texto' => $data['texto'],
                'categoria_id' => $data['categoria_id'],
                'user_id' => Auth::id(),
            ]);

            return redirect()
                ->route('anotacoes.index')
                ->with('success_message', 'Anotação criada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao criar anotação: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error_message', 'Ocorreu um erro ao criar a anotação. Tente novamente.');
                // ->with('error_message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anotacao = Anotacao::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$anotacao) {
            return redirect()
                ->route('anotacoes.index')
                ->with('error_message', 'Anotacao não encontrada ou não pertence a você.');
        }

        return view('anotacoes.anotacao_show', compact('anotacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anotacao = Anotacao::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$anotacao) {
            return redirect()
                ->route('anotacoes.index')
                ->with('error_message', 'Anotacao não encontrada ou não pertence a você.');
        }

        $categorias = Categoria::where('user_id', Auth::id())->get();

        return view('anotacoes.anotacao_form', compact('anotacao', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'texto' => 'required|string',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);

        $anotacao = Anotacao::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$anotacao) {
            return redirect()->route('anotacoes.index')->with('error_message', 'Anotação não encontrada.');
        }

        $anotacao->update([
            'titulo' => $request->input('titulo'),
            'texto' => $request->input('texto'),
            'categoria_id' => $request->input('categoria_id'),
        ]);

        return redirect()
            ->route('anotacoes.index')
            ->with('success_message', 'Anotação alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anotacao = Anotacao::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$anotacao) {
            return redirect()
                ->route('anotacoes.index')
                ->with('error_message', 'Anotação não encontrada ou não pertence a você.');
        }

        try {
            $anotacao->delete();

            return redirect()
                ->route('anotacoes.index')
                ->with('success_message', 'Anotação excluída com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir anotacao: ' . $e->getMessage());

            return redirect()
                ->route('anotacoes.index')
                ->with('error_message', 'Erro ao excluir anotação. Tente novamente.');
        }
    }
}
