<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 mb-4 items-end">
    <div class="lg:col-span-3">
        <span class="text-sm text-gray-700 dark:text-gray-300">
            User Live Search
            <span class="text-xs text-gray-500 dark:text-gray-400">(use the search button before selecting the dropdown to search for a specific user)</span>
        </span>
    </div>
    <div>
        <x-ui::input
            type="text"
            id="live_search_email"
            name="live_search_email"
            placeholder="Email"
        />
    </div>
    <div>
        <x-ui::input
            type="text"
            id="live_search_userid"
            name="live_search_userid"
            placeholder="UserId"
        />
    </div>
    <div>
        <x-ui::button id="live_search_button" variant="primary" block>
            {{ trans('LaravelLogger::laravel-logger.dashboard.search.search') }}
        </x-ui::button>
    </div>
</div>
