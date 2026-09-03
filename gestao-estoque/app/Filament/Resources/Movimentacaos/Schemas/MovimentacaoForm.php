<?php

namespace App\Filament\Resources\Movimentacaos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MovimentacaoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('produto_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tipo')
                    ->required(),
                TextInput::make('quantidade')
                    ->required()
                    ->numeric(),
                Textarea::make('observacao')
                    ->columnSpanFull(),
            ]);
    }
}
