<?php

namespace App\Filament\Pages;

use App\Models\Student;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;
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
    use AuthorizesPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    public static string $permission = 'keluar.view';

    protected static string $view = 'filament.pages.siswa-keluar';

    protected static ?string $navigationGroup = 'Mutasi Data Siswa';
    protected static ?string $navigationLabel = "Siswa Keluar";

    protected static ?int $navigationSort = 4;

    public function mount(): void
    {
        static::authorizePageAccess();
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
                TextColumn::make('reports.id')
                    ->formatStateUsing(fn (string $state): string => count(explode(",",$state)))
                    ->label('Jumlah Semester'),

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
