<x-filament-widgets::widget class="fi-filament-info-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <div class="flex-1">
                <p class="text-xl m-0 p-0 font-bold">
                    {{env('APP_NAME')}}
                </p>

                <p class="text-xs text-gray-500 dark:text-gray-400">
                    {{ env('APP_VERSION') }}
                </p>
            </div>

            <div class="flex flex-col items-end gap-y-1">
                <x-filament::link
                    color="gray"
                    href="https://filamentphp.com/docs"
                    icon="heroicon-m-book-open"
                    icon-alias="panels::widgets.filament-info.open-documentation-button"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    {{ __('filament-panels::widgets/filament-info-widget.actions.open_documentation.label') }}
                </x-filament::link>

            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
