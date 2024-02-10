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

class Profile extends Page implements HasForms
{
    use InteractsWithForms;
    use AuthorizesPageAccess;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.profile-sekolah';

    public static string $permission = 'naik.view';

    protected static ?string $navigationGroup = 'Master Akademik';
    protected static ?string $navigationLabel = "Profil Sekolah";

    protected static ?int $navigationSort = 7;

    public ?array $data = [];

    public function mount(): void
    {
        $profile = \App\Models\Profile::findOrNew(1);

        if(!$profile->exists()){
            $profile->name = 'Sekolah';
            $profile->logo = 'Sekolah.jpg';
            $profile->save();
        }

        $this->form->fill($profile->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    TextInput::make('name')
                        ->required(),
                    FileUpload::make('logo')
                        ->image()
                        ->required()
                ]),
            ])
            ->statePath('data')
            ->columns(3);
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
        $profile = \App\Models\Profile::findOrNew(1);
        $profile->name = $data['name'];
        $profile->logo = $data['logo'];
        $profile->save();

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
