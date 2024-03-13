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
use Closure;
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
use Filament\Forms\Get;
use Filament\Forms\Set;
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
use Illuminate\Support\Facades\Hash;

class ProfileGuru extends Page implements HasForms
{
    use InteractsWithForms;
    use AuthorizesPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.profile-sekolah';

    public static string $permission = '';
    protected static ?string $navigationLabel = "ProfileSekolah";

    public ?array $data = [];

    public function mount(): void
    {
        static::authorizePageAccess();
        if (Auth::check()) {
            $user = Auth::user();
            $teacher = $user->teacher;
            $data = $teacher->toArray();
            $data['user'] = $user->toArray();

            $this->form->fill($data);

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
                Fieldset::make("ProfileSekolah")->schema([
                    TextInput::make('nuptk')
                        ->label('NUPTK')
                        ->type('number')->required()->numeric(),
                    TextInput::make('nip')
                        ->label('NIP')
                        ->type('number')->required()->numeric(),
                    TextInput::make('name')
                        ->label('Nama')
                        ->required(),
                    TextInput::make('birth_place')
                        ->label('Tempat Lahir')
                        ->required(),
                    DatePicker::make('birth_date')
                        ->label('Tanggal lahir')
                        ->rule('date')
                        ->required(),
                    TextInput::make('position')
                        ->label('Posisi')
                        ->required(),
                    Select::make('gender')
                        ->label('Gender')
                        ->options([
                            'pria' => "Pria",
                            'perempuan' => "Wanita"
                        ])
                        ->required(),
                    Select::make('level')
                        ->label('Level')
                        ->options([
                            'pns' => "PNS",
                            'swasta' => "swasta"
                        ])
                        ->required(),
                    Select::make('religion')
                        ->label('Agama')
                        ->options([
                            'islam' => 'Islam',
                            'kristen' => 'Kristen',
                        ])
                        ->required(),
                    TextInput::make('education')
                        ->label('Pendidikan Terakhir')
                        ->required(),
                    Textarea::make('address')
                        ->label('Alamat')
                        ->rows(7)->required(),
                    TextInput::make('phone')
                        ->label('Handphone')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email')
                        ->helperText("pasrtikan email sesui dengan user yang ada di akun")
                        ->required(),
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'menikah' => "Menikah",
                            'sendiri' => "Sendiri"
                        ])
                        ->required(),
                    DatePicker::make('work_start_date')
                        ->label('Tanggal Aktif')
                        ->rule('date')
                        ->nullable()
                        ->required(),
                ])->columns(1)
                    ->columnSpan(7),
                Group::make()->schema([
                    Fieldset::make('Photo')->schema([
                        FileUpload::make('photo')
                            ->label('')
                            ->required()
                            ->image()
                    ])->columns(1)
                ])->columns(1)->columnSpan(5)
            ])
            ->columns(12)
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')->action('update')
        ];
    }

    public function update()
    {
        $data = $this->form->getState();

        $user = Auth::user();

        $teacher = $user->teacher;

        $teacher->fill($data)->save();

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
