<?php

namespace App\Filament\Resources\ClasResource\Pages;

use App\Filament\Resources\ClasResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageClas extends ManageRecords
{
    protected static string $resource = ClasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
