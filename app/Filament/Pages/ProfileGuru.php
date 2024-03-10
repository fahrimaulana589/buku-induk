<?php

namespace App\Filament\Pages;

use App\Models\Clas;
use App\Models\ClassLesson;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\FilamentUser;
use Chiiya\FilamentAccessControl\Traits\AuthorizesPageAccess;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\CreateAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
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

class ProfileGuru extends Page implements HasForms
{
    use InteractsWithForms;
    use AuthorizesPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.profile-sekolah';

    public static string $permission = '';
    protected static ?string $navigationLabel = "Profil";

    public ?array $data = [];

    public function mount(): void
    {
        static::authorizePageAccess();
        if (Auth::check()) {
            $user = Auth::user();
            $teacher = $user->teacher;
            $this->form->fill($teacher->toArray());
        } else {

        }
    }

    public static function canView(): bool
    {
        if (Auth::check()) {
            $user = Auth::user();
            $result = $user->hasRole('Guru');
            return $result;
        } else {
            return false;
        }
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make("Profile")->schema([
                    TextInput::make('nuptk')
                        ->label('NUPTK')
                        ->type('number')->disabled()->numeric(),
                    TextInput::make('nip')
                        ->label('NIP')
                        ->type('number')->disabled()->numeric(),
                    TextInput::make('name')
                        ->label('Nama')
                        ->disabled(),
                    TextInput::make('birth_place')
                        ->label('Tempat Lahir')
                        ->disabled(),
                    DatePicker::make('birth_date')
                        ->label('Tanggal lahir')
                        ->rule('date')
                        ->disabled(),
                    TextInput::make('position')
                        ->label('Posisi')
                        ->disabled(),
                    Select::make('gender')
                        ->label('Gender')
                        ->options([
                            'pria' => "Pria",
                            'perempuan' => "Wanita"
                        ])
                        ->disabled(),
                    Select::make('level')
                        ->label('Level')
                        ->options([
                            'pns' => "PNS",
                            'swasta' => "swasta"
                        ])
                        ->disabled(),
                    Select::make('religion')
                        ->label('Agama')
                        ->options([
                            'islam' => 'Islam',
                            'kristen' => 'Kristen',
                        ])
                        ->disabled(),
                    TextInput::make('education')
                        ->label('Pendidikan Terakhir')
                        ->disabled(),
                    Textarea::make('address')
                        ->label('Alamat')
                        ->rows(7)->disabled(),
                    TextInput::make('phone')
                        ->label('Handphone')
                        ->disabled(),
                    TextInput::make('email')
                        ->label('Email')
                        ->helperText("pasrtikan email sesui dengan user yang ada di akun")
                        ->disabled(),
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'menikah' => "Menikah",
                            'sendiri' => "Sendiri"
                        ])
                        ->disabled(),
                    DatePicker::make('work_start_date')
                        ->label('Tanggal Aktif')
                        ->rule('date')
                        ->nullable()
                        ->disabled(),
                ])->columns(1)
                    ->columnSpan(7),
                Fieldset::make('Photo')->schema([
                    FileUpload::make('photo')
                        ->label('')
                        ->disabled()
                        ->image()
                ])->columns(1)->columnSpan(5)
            ])
            ->columns(12)
            ->statePath('data');
    }
}
