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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class NotesRelationManager extends RelationManager
{
    protected static string $relationship = 'notes';

    protected static ?string $inverseRelationship = 'report';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('value')
                    ->label('Catatan')
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label('Catatan'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(function (){
                        return $this->isVisible('report.update');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function (){
                        return $this->isVisible('report.update');
                    }),
                Tables\Actions\DeleteAction::make()
                    ->visible(function (){
                        return $this->isVisible('report.delete');
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->visible(function (){
                        return $this->isVisible('report.delete');
                    }),
                ]),
            ]);
    }

    protected static ?string $title = "Catatan";

    function isVisible(string $ability){
        $user = (Boolean) Auth::user()->can($ability);
        return $user;
    }
}
