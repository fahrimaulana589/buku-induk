<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralLabel = "Data Guru";

    protected static ?string $label = "Data Guru";

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = "Master Akademik";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\TextInput::make('nuptk')
                        ->label('NUPTK')
                        ->type('number')->required()->numeric(),
                    Forms\Components\TextInput::make('nip')
                        ->label('NIP')
                        ->type('number')->required()->numeric(),
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
                    Forms\Components\TextInput::make('position')
                        ->label('Posisi')
                        ->required(),
                    Forms\Components\Select::make('gender')
                        ->label('Gender')
                        ->options([
                            'menikah' => "Menikah",
                            'sendir' => "Sendiri"
                        ])
                        ->required(),
                    Forms\Components\Select::make('level')
                        ->label('Level')
                        ->options([
                            'pns' => "PNS",
                            'swasta' => "swasta"
                        ])
                        ->required(),
                    Forms\Components\Select::make('religion')
                        ->label('Agama')
                        ->options([
                            'islam' => 'Islam',
                            'kristen' => 'Kristen',
                        ])
                        ->required(),
                    Forms\Components\TextInput::make('education')
                        ->label('Pendidikan Terakhir')
                        ->required(),
                    Forms\Components\Textarea::make('address')
                        ->label('Alamat')
                        ->rows(7)->required(),
                    Forms\Components\TextInput::make('phone')
                        ->label('Handphone')
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'menikah' => "Menikah",
                            'sendir' => "Sendiri"
                        ])
                        ->required(),
                    Forms\Components\DatePicker::make('work_start_date')
                        ->label('Tanggal Aktif')
                        ->rule('date')
                        ->nullable(),
                ])->columnSpan(7),
                Forms\Components\Group::make()->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->image()
                        ->required()
                ])->columnSpan(5)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('religion')
                    ->label('Agama'),
                Tables\Columns\TextColumn::make('phone'),
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
            'index' => Pages\ManageTeachers::route('/'),
        ];
    }
}
