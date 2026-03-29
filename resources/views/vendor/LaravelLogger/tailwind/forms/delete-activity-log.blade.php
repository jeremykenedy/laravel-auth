<form id="deleteActivityForm" action="{{ route('destroy-activity') }}" method="POST">
    @csrf
    @method('DELETE')
    <button
        type="button"
        x-data
        x-on:click="$dispatch('open-confirm', {
            title: '{{ trans('LaravelLogger::laravel-logger.modals.deleteLog.title') }}',
            message: '{{ trans('LaravelLogger::laravel-logger.modals.deleteLog.message') }}',
            variant: 'danger',
            formId: 'deleteActivityForm'
        })"
        class="flex w-full items-center gap-2 px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" /></svg>
        {{ trans('LaravelLogger::laravel-logger.dashboardCleared.menu.deleteAll') }}
    </button>
</form>
