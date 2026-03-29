<form id="restoreActivityForm" action="{{ route('restore-activity') }}" method="POST">
    @csrf
    <button
        type="button"
        x-data
        x-on:click="$dispatch('open-confirm', {
            title: '{{ trans('LaravelLogger::laravel-logger.modals.restoreLog.title') }}',
            message: '{{ trans('LaravelLogger::laravel-logger.modals.restoreLog.message') }}',
            variant: 'success',
            formId: 'restoreActivityForm'
        })"
        class="flex w-full items-center gap-2 px-4 py-2 text-sm text-green-600 dark:text-green-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
        {{ trans('LaravelLogger::laravel-logger.dashboardCleared.menu.restoreAll') }}
    </button>
</form>
