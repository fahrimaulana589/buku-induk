<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Father;
use App\Models\Mother;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $pluralLabel = "Data Murid";

    protected static ?string $label = "Data Murid";
    protected static ?string $navigationGroup = "Master Siswa";
    protected static ?int $navigationSort = 3;

    public function mount(): void
    {

    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('class_id')
                        ->label('Kelas')
                        ->relationship('class', 'name')
                        ->required(),
                    Forms\Components\Select::make('father_id')
                        ->label('Ayah')
                        ->relationship('father', 'name')
                        ->live()
                        ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                            $father = Father::find($get('father_id'));
                            if ($father != null) {
                                $set('ayah_nama', $father->name);
                                $set('ayah_alamat', $father->address);
                            }
                        })
                        ->visible(function (Forms\Set $set, Forms\Get $get) {
                            $father = Father::find($get('father_id'));
                            if ($father != null) {
                                $set('ayah_nama', $father->name);
                                $set('ayah_alamat', $father->address);
                            };
                            return true;
                        })
                        ->required(),
                    Forms\Components\Select::make('mother_id')
                        ->label('Ibu')
                        ->relationship('mother', 'name')
                        ->live()
                        ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                            $mother = Mother::find($get('mother_id'));
                            if ($mother != null) {
                                $set('ibu_nama', $mother->name);
                                $set('ibu_alamat', $mother->address);
                            }
                        })
                        ->visible(function (Forms\Set $set, Forms\Get $get) {
                            $mother = Mother::find($get('mother_id'));
                            if ($mother != null) {
                                $set('ibu_nama', $mother->name);
                                $set('ibu_alamat', $mother->address);
                            };
                            return true;
                        })
                        ->required(),
                    Forms\Components\TextInput::make('nis')->type('number')
                        ->required(),
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->required(),
                    Forms\Components\Select::make('gender')
                        ->options([
                            'Laki laki', 'Perempuan'
                        ]),
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
                    Forms\Components\TextInput::make('fam_order')
                        ->type('number')
                        ->label('Anak ke')
                        ->required(),
                    Forms\Components\TextInput::make('fam_count')
                        ->type('number')
                        ->label('Jumlah Saudara')
                        ->required(),
                    Forms\Components\TextInput::make('fam_status')
                        ->label('Status Dalam Keluarga')
                        ->required(),
                    Forms\Components\TextInput::make('language')
                        ->label('Bahasa keseharian')
                        ->required(),
                    Forms\Components\TextInput::make('phone')
                        ->label('Handphone')
                        ->required(),
                    Forms\Components\Textarea::make('address')
                        ->label('Alamat')
                        ->rows(7)->required(),
                    Forms\Components\TextInput::make('live_with')
                        ->label('Hidup dengan')
                        ->required(),
                    Forms\Components\TextInput::make('blood_type')
                        ->label('Tipe Darah')
                        ->required(),
                    Forms\Components\TextInput::make('height')
                        ->type('number')
                        ->label('Tinggi')
                        ->required(),
                    Forms\Components\TextInput::make('weight')
                        ->type('number')
                        ->label('Berat')
                        ->required(),
                    Forms\Components\TextInput::make('hobby')
                        ->label('Hobi')
                        ->required(),
                ])->columnSpan(7),
                Forms\Components\Group::make()->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->image()
                        ->required(),
                    Forms\Components\TextInput::make('ayah_nama')
                        ->label('Nama Ayah')
                        ->placeholder('kosong')
                        ->visible(function (Get $get) {
                            return !($get('father_id') == null);
                        })
                        ->disabled(),
                    Forms\Components\Textarea::make('ayah_alamat')
                        ->rows(5)
                        ->label('Alamat Ayah')
                        ->placeholder('kosong')
                        ->visible(function (Get $get) {
                            return !($get('father_id') == null);
                        })
                        ->disabled(),
                    Forms\Components\TextInput::make('ibu_nama')
                        ->label('Nama Ibu')
                        ->placeholder('kosong')
                        ->visible(function (Get $get) {
                            return !($get('mother_id') == null);
                        })
                        ->disabled(),
                    Forms\Components\Textarea::make('ibu_alamat')
                        ->rows(5)
                        ->label('Alamat Ibu')
                        ->visible(function (Get $get) {
                            return !($get('mother_id') == null);
                        })
                        ->placeholder('kosong')
                        ->disabled()
                ])->columnSpan(5)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('birth_date')
                    ->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('religion')
                    ->label('Agama'),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ManageStudents::route('/'),
            'view' => Pages\ViewStudent::route('/{record}'),
        ];
    }
}
