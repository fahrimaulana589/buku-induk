<?php

namespace App\Filament\Pages;

use App\Models\Student;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SiswaKeluar extends Page implements HasForms,HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.siswa-keluar';

    protected static ?string $navigationGroup = 'Mutasi Data Siswa';
    protected static ?string $navigationLabel = "Siswa Keluar";

    protected static ?int $navigationSort = 4;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query()->where('status','=','dropout'))
            ->columns([
                ImageColumn::make('photo'),
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('keluar.name')
                    ->label('Lulusan Tahun'),
                TextColumn::make('keluar')
                    ->formatStateUsing(fn (string $state): string => json_decode($state)->pivot->semester)
                    ->label('Semester'),
                TextColumn::make('keluar')
                    ->formatStateUsing(fn (string $state): string => json_decode($state)->pivot->reason)
                    ->label('Alasan'),
                TextColumn::make('gender'),
                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir'),
                TextColumn::make('religion')
                    ->label('Agama'),
            ])
            ->filters([
                SelectFilter::make('lulus')
                    ->label('Lulusan Tahun')
                    ->relationship('lulus','name'),
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
            ->bulkActions([

            ]);
    }
}
