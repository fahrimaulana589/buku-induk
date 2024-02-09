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

class SiswaLulus extends Page implements HasForms,HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;
    use AuthorizesPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    public static string $permission = 'lulus.view';
    protected static string $view = 'filament.pages.siswa-lulus';
    protected static ?string $navigationGroup = 'Mutasi Data Siswa';
    protected static ?string $navigationLabel = "Siswa Tamat";

    protected static ?int $navigationSort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query()->where('status','=','graduate'))
            ->columns([
                ImageColumn::make('photo'),
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('lulus.name')
                    ->label('Lulusan Tahun'),
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
