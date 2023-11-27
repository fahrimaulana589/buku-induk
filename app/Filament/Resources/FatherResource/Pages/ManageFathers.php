<?php

namespace App\Filament\Resources\FatherResource\Pages;

use App\Filament\Resources\FatherResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFathers extends ManageRecords
{
    protected static string $resource = FatherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
