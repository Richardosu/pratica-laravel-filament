<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function index()
    {
        $movimentacoes = Movimentacao::with(['produto', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('movimentacoes.index', compact('movimentacoes'));
    }

    public function create()
    {
        $produtos = Produto::orderBy('nome')->get();
        return view('movimentacoes.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'tipo' => 'required|in:entrada,saida',
            'quantidade' => 'required|integer|min:1',
            'observacao' => 'nullable|string',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        if ($request->tipo === 'saida' && $request->quantidade > $produto->quantidade) {
            return back()->withErrors(['quantidade' => 'Quantidade insuficiente em estoque. Disponível: ' . $produto->quantidade])->withInput();
        }

        Movimentacao::create([
            'produto_id' => $request->produto_id,
            'user_id' => auth()->id(),
            'tipo' => $request->tipo,
            'quantidade' => $request->quantidade,
            'observacao' => $request->observacao,
        ]);

        if ($request->tipo === 'entrada') {
            $produto->increment('quantidade', $request->quantidade);
        } else {
            $produto->decrement('quantidade', $request->quantidade);
        }

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação registrada com sucesso!');
    }
}
