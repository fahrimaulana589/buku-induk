<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuardianResource\Pages;
use App\Filament\Resources\GuardianResource\RelationManagers;
use App\Models\Father;
use App\Models\Guardian;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class GuardianResource extends Resource
{
    protected static ?string $model = Guardian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = "Data Wali murid";

    protected static ?string $label = "Data Wali murid";
    protected static ?string $navigationGroup = "Master Siswa";

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('student_id')
                        ->label('Murid')
                        ->relationship('student', 'name')
                        ->unique(ignorable: fn ($record) => $record)
                        ->live()
                        ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                            $murid = Student::find($get('student_id'));
                            if ($murid != null) {
                                $set('nis', $murid->nis);
                                $set('name_murid', $murid->name);
                                $set('address_murid', $murid->nis);
                            }
                        })
                        ->disabled(function (Forms\Set $set, Forms\Get $get) {
                            $murid = Student::find($get('student_id'));
                            if ($murid != null) {
                                $set('nis', $murid->nis);
                                $set('name_murid', $murid->name);
                                $set('address_murid', $murid->nis);
                            }
                            return false;
                        })
                        ->required(),
                    Forms\Components\Select::make('type')
                        ->options([
                            'ayah' => 'Ayah',
                            'ibu' => 'Ibu',
                            'lainya' => 'Lainya',
                        ])->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                            if ($get('type') == 'ayah') {
                                $murid = Student::find($get('student_id'));
                                if ($murid != null) {
                                    $set('name', $murid->father->name);
                                    $set('birth_place', $murid->father->birth_place);
                                    $set('birth_date', $murid->father->birth_date);
                                    $set('religion', $murid->father->religion);
                                    $set('citizenship', $murid->father->citizenship);
                                    $set('status', 'ayah');
                                    $set('phone', $murid->father->phone);
                                    $set('address', $murid->father->address);
                                }
                            }elseif ($get('type') == 'ibu'){
                                $murid = Student::find($get('student_id'));
                                if ($murid != null) {
                                    $set('name', $murid->mother->name);
                                    $set('birth_place', $murid->mother->birth_place);
                                    $set('birth_date', $murid->mother->birth_date);
                                    $set('religion', $murid->mother->religion);
                                    $set('citizenship', $murid->mother->citizenship);
                                    $set('status', 'ibu');
                                    $set('phone', $murid->mother->phone);
                                    $set('address', $murid->mother->address);
                                }
                            };
                        })
                        ->disabled(function (Get $get,Forms\Set $set) {
                            if ($get('type') == 'ayah') {
                                $murid = Student::find($get('student_id'));
                                if ($murid != null) {
                                    $set('name', $murid->father->name);
                                    $set('birth_place', $murid->father->birth_place);
                                    $set('birth_date', $murid->father->birth_date);
                                    $set('religion', $murid->father->religion);
                                    $set('citizenship', $murid->father->citizenship);
                                    $set('status', 'ayah');
                                    $set('phone', $murid->father->phone);
                                    $set('address', $murid->father->address);
                                }
                            }elseif ($get('type') == 'ibu'){
                                $murid = Student::find($get('student_id'));
                                if ($murid != null) {
                                    $set('name', $murid->mother->name);
                                    $set('birth_place', $murid->mother->birth_place);
                                    $set('birth_date', $murid->mother->birth_date);
                                    $set('religion', $murid->mother->religion);
                                    $set('citizenship', $murid->mother->citizenship);
                                    $set('status', 'ibu');
                                    $set('phone', $murid->mother->phone);
                                    $set('address', $murid->mother->address);
                                }
                            };
                            return ($get('student_id') == null);
                        })->live()->required()
                    ,
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->required(),
                    Forms\Components\TextInput::make('birth_place')
                        ->label('Tempat Lahir')
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->required(),
                    Forms\Components\DatePicker::make('birth_date')
                        ->label('Tanggal lahir')
                        ->rule('date')
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->required(),
                    Forms\Components\Select::make('religion')
                        ->label('Agama')
                        ->options([
                            'islam' => 'Islam',
                            'kristen' => 'Kristen',
                        ])
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->required(),
                    Forms\Components\TextInput::make('citizenship')
                        ->label('Kota/Kabupaten')
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->required(),
                    Forms\Components\TextInput::make('status')
                        ->label('Status')
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->required(),
                    Forms\Components\Textarea::make('address')
                        ->label('Alamat')
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->rows(7)->required(),
                    Forms\Components\TextInput::make('phone')
                        ->label('Handphone')
                        ->disabled(function (Get $get) {
                            return ($get('type') == null || $get('type') != 'lainya') || $get('student_id') == null;
                        })
                        ->required(),
                ])->columnSpan(7),
                Forms\Components\Group::make()->schema([
                    Forms\Components\TextInput::make('nis')->type('number')
                        ->label('NIS Murid')
                        ->disabled(),
                    Forms\Components\TextInput::make('name_murid')
                        ->label('Nama Murid')
                        ->disabled(),
                    Forms\Components\Textarea::make('address_murid')
                        ->label('Alamat Murid')
                        ->rows(7)
                        ->disabled(),
                ])->columnSpan(5)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Murid')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Wali Murid'),
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
            'index' => Pages\ManageGuardians::route('/'),
        ];
    }
}
