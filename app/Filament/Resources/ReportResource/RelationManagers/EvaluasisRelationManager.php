<?php

namespace App\Filament\Resources\ReportResource\RelationManagers;

use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EvaluasisRelationManager extends RelationManager
{
    protected static string $relationship = 'evaluasis';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('value')
                    ->label('Nilai')
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->visible(function (){
                        $user = Auth::user()->can('report.update');
                        return $user;
                    })
                    ->form(fn(AttachAction $action): array => [
                        $action
                            ->recordSelectOptionsQuery(fn (Builder $query) => $query->where('type','!=','induk'))
                            ->getRecordSelect()
                            ->label('Pelajaran'),
                        TextInput::make('value')
                            ->label('Nilai')
                    ])->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make()
                    ->visible(function (){
                        $user = Auth::user()->can('report.update');
                        return $user;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->visible(function (){
                            $user = Auth::user()->can('report.update');
                            return $user;
                        }),
                ]),
            ]);
    }

    protected static ?string $title = "Nilai Karakter";
}
