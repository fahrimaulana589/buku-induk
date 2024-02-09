<?php

namespace App\Filament\Pages;

use App\Models\Clas;
use App\Models\Student;
use App\Models\User;
use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
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
use Illuminate\Support\Facades\Auth;

class MutasiKelas extends Page implements HasForms,HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    use AuthorizesPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-up-down';

    protected static string $view = 'filament.pages.mutasi-kelas';

    public static string $permission = 'naik.view';

    protected static ?string $navigationGroup = 'Mutasi Data Siswa';
    protected static ?string $navigationLabel = "Naik/Ganti Kelas";

    protected static ?int $navigationSort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query())
            ->columns([
                ImageColumn::make('photo'),
                TextColumn::make('name')
                    ->searchable()
                    ->label('Nama'),
                TextColumn::make('class.name')
                    ->label('Kelas'),
                TextColumn::make('gender'),
                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir'),
                TextColumn::make('religion')
                    ->label('Agama'),
                TextColumn::make('status')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('class')
                    ->label('Kelas')
                    ->relationship('class','name'),
                SelectFilter::make('gender')
                    ->options([
                        'laki laki' => 'laki laki',
                        'perempuan' => 'perempuan',
                    ])
                    ->attribute('gender'),
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Aktif',
                        'graduate' => 'Lulus',
                        'dropout' => 'Berhenti',
                    ])
                    ->attribute('status'),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                // ...
            ])
            ->groupedBulkActions([
                // ...
                BulkAction::make('Mutasi')
                    ->visible(function (){
                        $user = Auth::user()->can('naik.update');
                        return $user;
                    })
                    ->form([
                        Select::make('class_id')
                            ->label('Kelas')
                            ->relationship('class', 'name')
                            ->required(),
                    ])
                    ->action(function (Collection $records) use ($table) {
                        $data = $table->getLivewire()->getMountedTableBulkActionForm()->getState();

                        $records->each(function (Student $record) use ($data) {
                            $record->update($data);
                            $record->update(['status' => 'active']);
                            $record->keluar()->detach();
                            $record->lulus()->detach();
                        });


                    })
                ,
                BulkAction::make('Lulus')
                    ->visible(function (){
                        $user = Auth::user()->can('naik.update');
                        return $user;
                    })
                    ->form([
                        Select::make('school_year_id')
                            ->label('Tahun Ajaran')
                            ->relationship('lulus', 'name')
                            ->required(),
                    ])
                    ->action(function (Collection $records) use ($table) {
                        $data = $table->getLivewire()->getMountedTableBulkActionForm()->getState();

                        $records->each(function (Student $record) use ($data) {
                            $record->update(['status' => 'graduate']);
                            $record->lulus()->sync($data['school_year_id']);
                            $record->keluar()->detach();
                        });
                    })
                ,
                BulkAction::make('Keluar')
                    ->visible(function (){
                        $user = Auth::user()->can('naik.update');
                        return $user;
                    })
                    ->form([
                        Select::make('school_year_id')
                            ->label('Tahun Ajaran')
                            ->relationship('lulus', 'name')
                            ->required(),
                        Select::make('semester')
                            ->label('Semester')
                            ->options([
                                'genap'=>'Genap',
                                'ganjil' => 'Ganjil'
                            ])
                            ->required(),
                        Textarea::make('reason')
                        ->label('Alasan')
                    ])
                    ->action(function (Collection $records) use ($table) {
                        $data = $table->getLivewire()->getMountedTableBulkActionForm()->getState();

                        $records->each(function (Student $record) use ($data) {
                            $record->update(['status' => 'dropout']);
                            $record->keluar()->sync([
                                $data['school_year_id']=>[
                                    'semester' => $data['semester'],
                                    'reason' => $data['reason'],
                                ]
                            ]);
                            $record->lulus()->detach();
                        });
                    })
                ,
            ]);
    }

}
