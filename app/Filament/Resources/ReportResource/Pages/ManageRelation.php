<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ClasResource;
use App\Filament\Resources\Pages\AttachRecord;
use App\Filament\Resources\ReportResource;
use App\Models\Clas;
use App\Models\Report;
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
    protected static ?string $model = Report::class;
    protected static string $resource = ReportResource::class;

    public function getBreadcrumb(): string
    {
        return $this->record->student->name;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ])->columns(1);
    }

    public function getTitle(): string|Htmlable
    {
        $tahun_ajaran = $this->record->schoolYearh->name;
        $kelas = $this->record->class->name;

        return "{$kelas} ({$tahun_ajaran})";
    }
}
