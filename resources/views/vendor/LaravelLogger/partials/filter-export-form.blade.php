{{-- Date Filtering and Export Form --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fa fa-filter"></i> {{ trans('LaravelLogger::laravel-logger.filterAndExport') }}
        </h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('activity') }}" class="form-inline">
            {{-- Date Range Filtering --}}
            @if(config('LaravelLogger.enableDateFiltering'))
            <div class="form-group mr-3">
                <label for="date_from" class="mr-2">{{ trans('LaravelLogger::laravel-logger.fromDate') }}:</label>
                <input type="date" name="date_from" id="date_from" class="form-control" 
                       value="{{ request('date_from') }}" />
            </div>
            
            <div class="form-group mr-3">
                <label for="date_to" class="mr-2">{{ trans('LaravelLogger::laravel-logger.toDate') }}:</label>
                <input type="date" name="date_to" id="date_to" class="form-control" 
                       value="{{ request('date_to') }}" />
            </div>
            
            <div class="form-group mr-3">
                <label for="period" class="mr-2">{{ trans('LaravelLogger::laravel-logger.quickPeriod') }}:</label>
                <select name="period" id="period" class="form-control">
                    <option value="">{{ trans('LaravelLogger::laravel-logger.allTime') }}</option>
                    <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>
                        {{ trans('LaravelLogger::laravel-logger.today') }}
                    </option>
                    <option value="yesterday" {{ request('period') == 'yesterday' ? 'selected' : '' }}>
                        {{ trans('LaravelLogger::laravel-logger.yesterday') }}
                    </option>
                    <option value="last_7_days" {{ request('period') == 'last_7_days' ? 'selected' : '' }}>
                        {{ trans('LaravelLogger::laravel-logger.last7Days') }}
                    </option>
                    <option value="last_30_days" {{ request('period') == 'last_30_days' ? 'selected' : '' }}>
                        {{ trans('LaravelLogger::laravel-logger.last30Days') }}
                    </option>
                    <option value="last_3_months" {{ request('period') == 'last_3_months' ? 'selected' : '' }}>
                        {{ trans('LaravelLogger::laravel-logger.last3Months') }}
                    </option>
                    <option value="last_6_months" {{ request('period') == 'last_6_months' ? 'selected' : '' }}>
                        {{ trans('LaravelLogger::laravel-logger.last6Months') }}
                    </option>
                    <option value="last_year" {{ request('period') == 'last_year' ? 'selected' : '' }}>
                        {{ trans('LaravelLogger::laravel-logger.lastYear') }}
                    </option>
                </select>
            </div>
            @endif
            
            {{-- Search Fields --}}
            @if(config('LaravelLogger.enableSearch'))
            <div class="form-group mr-3">
                <label for="description" class="mr-2">{{ trans('LaravelLogger::laravel-logger.description') }}:</label>
                <input type="text" name="description" id="description" class="form-control" 
                       value="{{ request('description') }}" placeholder="{{ trans('LaravelLogger::laravel-logger.searchDescription') }}" />
            </div>
            
            <div class="form-group mr-3">
                <label for="user" class="mr-2">{{ trans('LaravelLogger::laravel-logger.user') }}:</label>
                <select name="user" id="user" class="form-control">
                    <option value="">{{ trans('LaravelLogger::laravel-logger.allUsers') }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->{config('LaravelLogger.defaultUserIDField')} }}" 
                                {{ request('user') == $user->{config('LaravelLogger.defaultUserIDField')} ? 'selected' : '' }}>
                            {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            
            <div class="form-group mr-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i> {{ trans('LaravelLogger::laravel-logger.filter') }}
                </button>
            </div>
            
            <div class="form-group mr-3">
                <a href="{{ route('activity') }}" class="btn btn-secondary">
                    <i class="fa fa-refresh"></i> {{ trans('LaravelLogger::laravel-logger.clearFilters') }}
                </a>
            </div>
        </form>
        
        {{-- Export Buttons --}}
        @if(config('LaravelLogger.enableExport'))
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h6>{{ trans('LaravelLogger::laravel-logger.exportData') }}:</h6>
                <div class="btn-group" role="group">
                    <a href="{{ route('export-activity', array_merge(request()->query(), ['format' => 'csv'])) }}" 
                       class="btn btn-success btn-sm">
                        <i class="fa fa-file-csv"></i> {{ trans('LaravelLogger::laravel-logger.exportCSV') }}
                    </a>
                    <a href="{{ route('export-activity', array_merge(request()->query(), ['format' => 'json'])) }}" 
                       class="btn btn-info btn-sm">
                        <i class="fa fa-file-code"></i> {{ trans('LaravelLogger::laravel-logger.exportJSON') }}
                    </a>
                    <a href="{{ route('export-activity', array_merge(request()->query(), ['format' => 'excel'])) }}" 
                       class="btn btn-warning btn-sm">
                        <i class="fa fa-file-excel"></i> {{ trans('LaravelLogger::laravel-logger.exportExcel') }}
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
