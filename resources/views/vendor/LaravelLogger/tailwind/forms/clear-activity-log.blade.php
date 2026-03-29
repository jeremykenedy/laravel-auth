<form id="clearActivityForm" action="{{ route('clear-activity') }}" method="POST">
    @csrf
    @method('DELETE')
    <button
        type="button"
        x-data
        x-on:click="$dispatch('open-confirm', {
            title: '{{ trans('LaravelLogger::laravel-logger.modals.clearLog.title') }}',
            message: '{{ trans('LaravelLogger::laravel-logger.modals.clearLog.message') }}',
            variant: 'danger',
            formId: 'clearActivityForm'
        })"
        class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
        {{ trans('LaravelLogger::laravel-logger.dashboard.menu.clear') }}
    </button>
</form>
