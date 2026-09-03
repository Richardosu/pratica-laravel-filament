<?php

use App\Http\Controllers\MovimentacaoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalProdutos = \App\Models\Produto::count();
    $estoqueBaixo = \App\Models\Produto::whereColumn('quantidade', '<=', 'estoque_minimo')->count();
    $valorTotalEstoque = \App\Models\Produto::sum(\Illuminate\Support\Facades\DB::raw('quantidade * preco'));
    $ultimasMovimentacoes = \App\Models\Movimentacao::with(['produto', 'user'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    return view('dashboard', compact('totalProdutos', 'estoqueBaixo', 'valorTotalEstoque', 'ultimasMovimentacoes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('produtos', ProdutoController::class);
    Route::resource('movimentacoes', MovimentacaoController::class)->only(['index', 'create', 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
