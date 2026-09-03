<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'categoria',
        'descricao',
        'quantidade',
        'preco',
        'estoque_minimo',
    ];

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }
}