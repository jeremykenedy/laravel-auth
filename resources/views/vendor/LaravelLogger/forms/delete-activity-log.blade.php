<form action="{{ route('destroy-activity') }}" method="POST" class="mb-0">
    @csrf
    @method('DELETE')
    <button type="button" class="text-danger dropdown-item" data-toggle="modal" data-target="#confirmDelete" data-title="{{ trans('LaravelLogger::laravel-logger.modals.deleteLog.title') }}" data-message="{{ trans('LaravelLogger::laravel-logger.modals.deleteLog.message') }}">
        <i class="fa fa-fw fa-eraser" aria-hidden="true"></i>{{ trans('LaravelLogger::laravel-logger.dashboardCleared.menu.deleteAll') }}
    </button>
</form>
