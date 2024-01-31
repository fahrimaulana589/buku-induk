<?php

namespace App\Filament\Pages;

use App\Models\Clas;
use App\Models\Report;
use App\Models\SchoolYear;
use App\Models\Student;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class SiswaAktif extends Page implements HasForms,HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.siswa-aktif';
    protected static ?string $navigationGroup = 'Mutasi Data Siswa';
    protected static ?string $navigationLabel = "Siswa Aktif";

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query()->where('status','=','active'))
            ->columns([
                ImageColumn::make('photo'),
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('class.name')
                    ->label('Kelas'),
                TextColumn::make('gender'),
                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir'),
                TextColumn::make('religion')
                    ->label('Agama'),
            ])
            ->filters([
                SelectFilter::make('class')
                    ->label('Kelas')
                    ->relationship('class','name'),
                SelectFilter::make('gender')
                    ->options([
                        'laki laki' => 'laki laki',
                        'perempuan' => 'perempuan',
                    ])
                    ->attribute('gender'),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                // ...
            ])
            ->groupedBulkActions([
                BulkAction::make('Report')
                    ->form([
                        Select::make('class_id')
                            ->label('Kelas')
                            ->options(Clas::all()->pluck('name', 'id'))
                            ->required(),
                        Select::make('school_year_id')
                            ->label('Tahun Ajaran')
                            ->options(SchoolYear::all()->pluck('name', 'id'))
                            ->required(),
                        Select::make('semester')
                            ->label('Semester')
                            ->options([
                                'ganjil' => 'Ganjil',
                                'genap' => 'Genap'
                            ])
                            ->required(),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'lulus' => 'Lulus',
                                'tidak' => 'Tidak'
                            ]),
                    ])
                    ->action(function (Collection $records) use ($table) {
                        $data = $table->getLivewire()->getMountedTableBulkActionForm()->getState();

                        $records->each(function (Student $record) use ($data) {
                            $data['student_id'] = $record->id;
                            Report::create($data);
                        });
                    })
                ,
            ]);
    }

}
