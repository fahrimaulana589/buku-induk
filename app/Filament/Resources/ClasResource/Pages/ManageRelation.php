<?php

namespace App\Filament\Resources\ClasResource\Pages;

use App\Filament\Resources\ClasResource;
use App\Filament\Resources\Pages\AttachRecord;
use App\Models\Clas;
use App\Models\Teacher;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;

class ManageRelation extends AttachRecord
{
    protected static ?string $model = Clas::class;
    protected static string $resource = ClasResource::class;

    public function getBreadcrumb(): string
    {
        $pelajaran = $this->record;
        return $pelajaran->name;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ])->columns(1);
    }

    public function getTitle(): string|Htmlable
    {
        $pelajaran = $this->record;
        return "Wali kelas ".$pelajaran->teacher->name;
    }
}
