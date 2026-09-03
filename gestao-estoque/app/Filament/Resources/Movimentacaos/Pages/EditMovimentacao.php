<?php

namespace App\Filament\Resources\Movimentacaos\Pages;

use App\Filament\Resources\Movimentacaos\MovimentacaoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMovimentacao extends EditRecord
{
    protected static string $resource = MovimentacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
