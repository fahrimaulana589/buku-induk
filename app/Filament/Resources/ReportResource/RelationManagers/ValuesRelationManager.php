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
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class ValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'values';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('value')
                    ->label('Nilai')
                    ->type('number')
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
                        return $this->isVisible('report.update');
                    })
                    ->form(fn(AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->label('Pelajaran'),
                        Forms\Components\Select::make('test_id')
                            ->label('Pengujian')
                            ->options(Test::all()->pluck('name', 'id')),
                        TextInput::make('value')
                            ->label('Nilai')
                            ->type('number')
                    ])->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make()
                    ->visible(function (){
                        return $this->isVisible('report.delete');
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->visible(function (){
                           return $this->isVisible('report.delete');
                        }),
                ]),
            ]);
    }

    function isVisible(string $ability){
        $user = (Boolean) Auth::user()->can($ability);
        return $user;
    }

    protected static ?string $title = "Nilai Matapelajaran";
}
