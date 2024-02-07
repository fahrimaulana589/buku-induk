<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluasiResource\Pages;
use App\Filament\Resources\EvaluasiResource\RelationManagers;
use App\Models\Evaluasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluasiResource extends Resource
{
    protected static ?string $model = Evaluasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';

    protected static ?string $pluralLabel = "Data Penilaian Sikap";

    protected static ?string $label = "Data Penilaian Sikap";
    protected static ?string $navigationGroup = "Master Akademik";
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'utama' => "Utama",
                        'induk' => 'Induk',
                        'turunan' => 'Turunan'
                    ])
                    ->required()
                    ->live(),
                Forms\Components\Select::make('evaluasi_id')
                    ->relationship('evaluasi','name',function (Builder $query){
                        return $query->where('type','=','induk');
                    })
                    ->required(function (Forms\Get $get){
                        return $get('type') == 'turunan';
                    })
                    ->disabled(function (Forms\Get $get){
                        return $get('type') != 'turunan';
                    }),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('evaluasi.name')
                    ->label('Induk'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEvaluasis::route('/'),
        ];
    }
}
