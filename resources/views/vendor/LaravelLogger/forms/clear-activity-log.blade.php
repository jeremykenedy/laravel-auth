<form action="{{ route('clear-activity') }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="button" data-toggle="modal" data-target="#confirmDelete" data-title="{{ trans('LaravelLogger::laravel-logger.modals.clearLog.title') }}" data-message="{{ trans('LaravelLogger::laravel-logger.modals.clearLog.message') }}" class="dropdown-item">
        <i class="fa fa-fw fa-trash" aria-hidden="true"></i>{{ trans('LaravelLogger::laravel-logger.dashboard.menu.clear') }}
    </button>
</form>
