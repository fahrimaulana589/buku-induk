<?php declare(strict_types=1);

namespace App\Filament\Resources;

use App\Models\Teacher;
use Carbon\Carbon;
use Chiiya\FilamentAccessControl\Contracts\AccessControlUser;
use Chiiya\FilamentAccessControl\Enumerators\Feature;
use Chiiya\FilamentAccessControl\Fields\PermissionGroup;
use Chiiya\FilamentAccessControl\Fields\RoleSelect;
use Chiiya\FilamentAccessControl\Resources\FilamentUserResource\Pages\CreateFilamentUser;
use Chiiya\FilamentAccessControl\Resources\FilamentUserResource\Pages\EditFilamentUser;
use Chiiya\FilamentAccessControl\Resources\FilamentUserResource\Pages\ListFilamentUsers;
use Chiiya\FilamentAccessControl\Resources\FilamentUserResource\Pages\ViewFilamentUser;
use Chiiya\FilamentAccessControl\Traits\HasExtendableSchema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class FilamentUserResource extends Resource
{
    use HasExtendableSchema;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema(
                        fn(Component $livewire) => $livewire instanceof ViewFilamentUser
                            ? [
                                ...static::insertBeforeFormSchema(),
                                static::detailsSection(),
                                Section::make(__('filament-access-control::default.sections.permissions'))
                                    ->description(__('filament-access-control::default.messages.permissions_view'))
                                    ->schema([
                                        PermissionGroup::make('permissions')
                                            ->label(__('filament-access-control::default.fields.permissions'))
                                            ->validationAttribute(
                                                __('filament-access-control::default.fields.permissions'),
                                            )
                                            ->resolveStateUsing(
                                                fn($record) => $record->getAllPermissions()->pluck('id')->all(),
                                            ),
                                    ]),
                                ...static::insertAfterFormSchema(),
                            ] : [
                                ...static::insertBeforeFormSchema(),
                                static::detailsSection(),
                                Section::make(__('filament-access-control::default.sections.permissions'))
                                    ->description(__('filament-access-control::default.messages.permissions_create'))
                                    ->schema([
                                        PermissionGroup::make('permissions')
                                            ->label(__('filament-access-control::default.fields.permissions'))
                                            ->validationAttribute(
                                                __('filament-access-control::default.fields.permissions'),
                                            ),
                                    ]),
                                ...static::insertAfterFormSchema(),
                            ],
                    )
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ...static::insertBeforeTableSchema(),
                TextColumn::make('full_name')
                    ->label(__('filament-access-control::default.fields.full_name'))
                    ->searchable(['first_name', 'last_name']),
                TextColumn::make('email')
                    ->label(__('filament-access-control::default.fields.email'))
                    ->searchable(),
                TextColumn::make('role')
                    ->label(__('filament-access-control::default.fields.role'))
                    ->getStateUsing(fn($record) => __(optional($record->roles->first())->name)),
                ...(
                Feature::enabled(Feature::ACCOUNT_EXPIRY)
                    ? [
                    IconColumn::make('active')
                        ->boolean()
                        ->label(__('filament-access-control::default.fields.active'))
                        ->getStateUsing(fn(AccessControlUser $record) => !$record->isExpired()),
                ]
                    : []
                ),
                ...static::insertAfterTableSchema(),
            ])
            ->actions([EditAction::make(), ViewAction::make()])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ...(
                    Feature::enabled(Feature::ACCOUNT_EXPIRY)
                        ? [
                        BulkAction::make('extend')
                            ->label(__('filament-access-control::default.actions.extend'))
                            ->action('extendUsers')
                            ->requiresConfirmation()
                            ->deselectRecordsAfterCompletion()
                            ->color('success')
                            ->icon('heroicon-o-clock'),
                    ]
                        : []
                    ),
                ]),
            ])
            ->emptyStateActions([CreateAction::make()])
            ->filters([
                ...(
                Feature::enabled(Feature::ACCOUNT_EXPIRY)
                    ? [
                    Filter::make(__('filament-access-control::default.filters.expired'))
                        ->query(
                            fn(Builder $query) => $query->whereNotNull(
                                'expires_at',
                            )->where('expires_at', '<=', now()),
                        ),
                ]
                    : []
                ),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFilamentUsers::route('/'),
            'create' => CreateFilamentUser::route('/create'),
            'edit' => EditFilamentUser::route('/{record}/edit'),
            'view' => ViewFilamentUser::route('/{record}'),
        ];
    }

    public static function getModel(): string
    {
        return config('filament-access-control.user_model');
    }

    public static function getLabel(): string
    {
        return __('filament-access-control::default.resources.admin_user');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-access-control::default.resources.admin_users');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('roles');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-access-control::default.resources.group');
    }

    protected static function detailsSectionSchema(): array
    {
        return [
            TextInput::make('first_name')
                ->label('Panggilan')
                ->validationAttribute(__('filament-access-control::default.fields.first_name'))
                ->required(),
            TextInput::make('last_name')
                ->label('Nama Lengkap')
                ->validationAttribute(__('filament-access-control::default.fields.last_name'))
                ->required(),
            TextInput::make('email')
                ->label(__('filament-access-control::default.fields.email'))
                ->validationAttribute(__('filament-access-control::default.fields.email'))
                ->required()
                ->email(),
            RoleSelect::make('role')
                ->label(__('filament-access-control::default.fields.role'))
                ->live()
                ->validationAttribute(__('filament-access-control::default.fields.role')),
            ...(
            Feature::enabled(Feature::ACCOUNT_EXPIRY)
                ? [
                DatePicker::make('expires_at')
                    ->label(__('filament-access-control::default.fields.expires_at'))
                    ->validationAttribute(__('filament-access-control::default.fields.expires_at'))
                    ->minDate(fn(Component $livewire) => static::evaluateMinDate($livewire))
                    ->displayFormat(config('filament-access-control.date_format'))
                    ->dehydrateStateUsing(
                        fn($state) => Carbon::parse($state)->endOfDay()->toDateTimeString(),
                    ),
            ]
                : []
            ),
            Select::make('teacher')
                ->relationship('teachers','name')
                ->live()
                ->required()
                ->visible(function (Get $get){
                    $result = false;
                    if($get('role') != null){
                        $role = Role::find($get('role'));
                        $result = $role->name == 'Guru' | $role->name == 'Wali Murid' ;
                    }
                    return $result;
                })
        ];
    }

    protected static function detailsSection(): Section
    {
        return Section::make(__('filament-access-control::default.sections.user_details'))
            ->schema(static::detailsSectionSchema());
    }

    protected static function evaluateMinDate(Component $livewire): ?Carbon
    {
        if ($livewire instanceof CreateFilamentUser) {
            return now();
        }

        return null;
    }
}
