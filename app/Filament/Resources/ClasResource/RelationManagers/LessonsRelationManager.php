<?php

namespace App\Filament\Resources\ClasResource\RelationManagers;

use App\Models\Lesson;
use App\Models\Teacher;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';

    protected static ?string $title = 'Pelajaran';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('day')
                    ->formatStateUsing(function (string $state) {
                        return array_slice(Carbon::getDays(),1)[$state];
                    })
                    ->label('Hari'),
                Tables\Columns\TextColumn::make('teacher_id')
                    ->formatStateUsing(function (string $state) {
                        return Teacher::find($state)->name;
                    })
                    ->label('Pengajar'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('day')
                    ->options(array_slice(Carbon::getDays(),1))
            ],layout: Tables\Enums\FiltersLayout::AboveContent)
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->visible(function () {
                        $user = Auth::user()->can('class.update');
                        return $user;
                    })
                    ->form(fn(AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->options(Lesson::all()->pluck('name','id'))
                            ->label('Pelajaran')
                            ->required(),
                        Forms\Components\Select::make('day')
                            ->options(array_slice(Carbon::getDays(),1))
                            ->required()
                            ->label('Hari'),
                        Forms\Components\Select::make('teacher_id')
                            ->label('Guru')
                            ->required()
                            ->options(Teacher::all()->pluck('name', 'id'))
                    ])
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->visible(function () {
                        $user = Auth::user()->can('class.update');
                        return $user;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->visible(function () {
                            $user = Auth::user()->can('class.update');
                            return $user;
                        }),
                ]),
            ]);
    }
}
