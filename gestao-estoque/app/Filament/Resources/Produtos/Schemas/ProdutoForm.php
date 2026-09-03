<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->required(),
                TextInput::make('categoria'),
                Textarea::make('descricao')
                    ->columnSpanFull(),
                TextInput::make('quantidade')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('preco')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('estoque_minimo')
                    ->required()
                    ->numeric()
                    ->default(5),
            ]);
    }
}
