<?php

namespace App\Filament\Pages;

use App\Models\Clas;
use App\Models\ClassLesson;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MutasiGuru extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use AuthorizesPageAccess;

    protected static ?string $navigationIcon = 'heroicon-s-arrow-path';

    protected static string $view = 'filament.pages.mutasi-guru';

    public static string $permission = 'ganti-kelas-guru.view';

    protected static ?string $navigationGroup = 'Mutasi Data Guru';
    protected static ?string $navigationLabel = "Ganti Kelas Ajar";

    protected static ?int $navigationSort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(ClassLesson::query())
            ->columns([
                TextColumn::make('teacher.name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('clas.name')
                    ->label('Kelas'),
                TextColumn::make('lesson.name')
                    ->label('Pelajaran'),
                TextColumn::make('day')
                    ->formatStateUsing(function (string $state) {
                        return array_slice(Carbon::getDays(), 1)[$state];
                    })
                    ->label('Hari'),
            ])
            ->filters([
                SelectFilter::make('day')->label('Hari')
                    ->options(array_slice(Carbon::getDays(), 1)),
                SelectFilter::make('clas')
                    ->relationship('clas', 'name')
                    ->label('Kelas')
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                // ...
                EditAction::make()
                    ->form([
                        Select::make('teacher_id')
                            ->label('Guru')
                            ->required()
                            ->options(Teacher::all()->pluck('name', 'id')),
                        Select::make('lesson_id')
                            ->options(Lesson::all()->pluck('name', 'id'))
                            ->label('Pelajaran')
                            ->required(),
                        Select::make('class_id')
                            ->options(Clas::all()->pluck('name', 'id'))
                            ->label('Kelas')
                            ->required(),
                        Select::make('day')
                            ->options(array_slice(Carbon::getDays(), 1))
                            ->required()
                            ->label('Hari'),
                    ])
                    ->visible(function () {
                        $user = Auth::user();
                        return $user->can('ganti-kelas-guru.update');
                    }),
                DeleteAction::make()
                    ->visible(function () {
                        $user = Auth::user();
                        return $user->can('ganti-kelas-guru.update');
                    }),
            ])
            ->groupedBulkActions([
                BulkAction::make('Ganti Kelas')
                    ->form([
                        Select::make('class_id')
                            ->options(Clas::all()->pluck('name', 'id'))
                            ->label('Kelas')
                            ->required(),
                    ])->action(function (Collection $records) use ($table) {
                        $data = $table->getLivewire()->getMountedTableBulkActionForm()->getState();
                        $records->each(function (ClassLesson $record) use ($data) {
                            $record->update($data);
                        });
                    })->visible(function () {
                        $user = Auth::user();
                        return $user->can('ganti-kelas-guru.update');
                    }),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Tambah')
                ->form([
                    Select::make('teacher_id')
                        ->label('Guru')
                        ->required()
                        ->options(Teacher::all()->pluck('name', 'id')),
                    Select::make('lesson_id')
                        ->options(Lesson::all()->pluck('name', 'id'))
                        ->label('Pelajaran')
                        ->required(),
                    Select::make('class_id')
                        ->options(Clas::all()->pluck('name', 'id'))
                        ->label('Kelas')
                        ->required(),
                    Select::make('day')
                        ->options(array_slice(Carbon::getDays(), 1))
                        ->required()
                        ->label('Hari'),
                ])->action(function ($data) {
                    ClassLesson::create($data);
                })
        ];
    }

}
