<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $pluralLabel = "Data Report";

    protected static ?string $label = "Data Report";
    protected static ?string $navigationGroup = "Master Report";
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('class_id')
                    ->label('Kelas')
                    ->relationship('class', 'name')
                    ->required(),
                Forms\Components\Select::make('student_id')
                    ->label('Murid')
                    ->relationship('student', 'name')
                    ->required(),
                Forms\Components\Select::make('school_year_id')
                    ->label('Tahun Ajaran')
                    ->relationship('schoolYearh', 'name')
                    ->required(),
                Forms\Components\Select::make('semester')
                    ->label('Semester')
                    ->options([
                        'ganjil' => 'Ganjil',
                        'genap' => 'Genap'
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'lulus' => 'Lulus',
                        'tidak' => 'Tidak'
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->label('Murid'),
                Tables\Columns\TextColumn::make('class.name')
                    ->label('Kelas'),
                Tables\Columns\TextColumn::make('schoolYearh.name')
                    ->label('Tahun Ajaran'),
                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('class')
                    ->label('Kelas')
                    ->relationship('class','name'),
                SelectFilter::make('schoolYearh')
                    ->label('Tahin Ajaran')
                    ->relationship('schoolYearh','name'),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('report')
                    ->icon('heroicon-s-clipboard-document-list')
                    ->url(function ($record){;
                        return route('filament.admin.resources.reports.values',$record->id);
                    })->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->visible(function (){
                        $user = Auth::user();
                        return $user->can('report.update');
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
            'index' => Pages\ManageReports::route('/'),
            'values' => Pages\ManageRelation::route('/{record}/data'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ValuesRelationManager::class,
            RelationManagers\EvaluasisRelationManager::class,
            RelationManagers\NotesRelationManager::class,
        ];
    }
}
