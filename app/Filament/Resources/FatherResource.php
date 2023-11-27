<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FatherResource\Pages;
use App\Filament\Resources\FatherResource\RelationManagers;
use App\Models\Father;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FatherResource extends Resource
{
    protected static ?string $model = Father::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = "Data Ayah";

    protected static ?string $label = "Data Ayah";
    protected static ?string $navigationGroup = "Master Siswa";
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                Forms\Components\TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->required(),
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Tanggal lahir')
                    ->rule('date')
                    ->required(),
                Forms\Components\Select::make('religion')
                    ->label('Agama')
                    ->options([
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('citizenship')
                    ->label('Kota/Kabupaten')
                    ->required(),
                Forms\Components\TextInput::make('education')
                    ->label('Pendidikan Terakhir')
                    ->required(),
                Forms\Components\TextInput::make('work')
                    ->label('Pekerjaan')
                    ->required(),
                Forms\Components\TextInput::make('monthly_income')
                    ->label('Penghasilan Bulanan')
                    ->type('number')->required()->numeric(),
                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->rows(7)->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('Handphone')
                    ->required(),
                Forms\Components\DatePicker::make('died_at')
                    ->label('Tanggal Wafat')
                    ->rule('date')
                    ->nullable(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('birth_place')
                    ->label('Tempat Lahir'),
                Tables\Columns\TextColumn::make('education')
                    ->label('Pendidikan Terakhir'),
                Tables\Columns\TextColumn::make('work')
                    ->label('Pekerjan'),
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
            'index' => Pages\ManageFathers::route('/'),
        ];
    }
}
