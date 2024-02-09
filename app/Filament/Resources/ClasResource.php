<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClasResource\Pages;
use App\Filament\Resources\ClasResource\Pages\EditClassLesson;
use App\Filament\Resources\ClasResource\RelationManagers;
use App\Models\Clas;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ClasResource extends Resource
{
    protected static ?string $model = Clas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $pluralLabel = "Data Kelas";

    protected static ?string $label = "Data Kelas";
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = "Master Akademik";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('teacher_id')
                        ->label('Wali Kelas')
                        ->relationship('teacher', 'name')
                        ->live()
                        ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get) {
                            $guru = Teacher::find($get('teacher_id'));
                            if ($guru != null) {
                                $set('nuptk', $guru->nuptk);
                                $set('name_guru', $guru->name);
                                $set('address_guru', $guru->address);
                            }
                        })
                        ->disabled(function (Forms\Set $set, Forms\Get $get){
                            $guru = Teacher::find($get('teacher_id'));
                            if ($guru != null) {
                                $set('nuptk', $guru->nuptk);
                                $set('name_guru', $guru->name);
                                $set('address_guru', $guru->address);
                            }
                            return false;
                        })
                        ->required(),
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Kelas')
                        ->disabled(function (Get $get) {
                            return ($get('teacher_id') == null);
                        })
                        ->required(),
                ])->columnSpan(7),
                Forms\Components\Group::make()->schema([
                    Forms\Components\TextInput::make('nuptk')->type('number')
                        ->label('NUPTK Guru')
                        ->disabled(),
                    Forms\Components\TextInput::make('name_guru')
                        ->label('Nama Guru')
                        ->disabled(),
                    Forms\Components\Textarea::make('address_guru')
                        ->label('Alamat Guru')
                        ->rows(7)
                        ->disabled(),
                ])->columnSpan(5)
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nama Kelas'),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->label('Nama Wali Kelas'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('pelajaran')
                    ->url(fn (Clas $record): string => route('filament.admin.resources.clas.lesson', $record))
                    ->openUrlInNewTab()
                    ->icon('heroicon-s-newspaper'),
                Tables\Actions\EditAction::make()
                    ->visible(function (){
                        $user = Auth::user()->can('class.update');
                        return $user;
                    }),
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
            'index' => Pages\ManageClas::route('/'),
            'lesson' => Pages\ManageRelation::route('/{record}/lessons'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LessonsRelationManager::class,
        ];
    }
}
