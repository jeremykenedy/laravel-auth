@php
    $userIdField = config('LaravelLogger.defaultUserIDField')
@endphp

<form action="{{route('activity')}}" method="get">
    <div class="row mb-3">
        @if(in_array('description',explode(',', config('LaravelLogger.searchFields'))))
            <div class="col-12 col-sm-4 col-lg-2 mb-2">
                <input type="text" name="description" value="{{request()->get('description') ? request()->get('description'):null}}" class="form-control" placeholder="{{ trans('LaravelLogger::laravel-logger.dashboard.labels.description') }}">
            </div>
        @endif
        @if(in_array('user',explode(',', config('LaravelLogger.searchFields'))))
            <div class="col-12 col-sm-4 col-lg-2 mb-2">
                <select class="form-control" id="user_select" name="user">
                    <option value="">{{ trans('LaravelLogger::laravel-logger.dashboard.search.all') }}</option>
                    @foreach($users as $user)
                        <option value="{{ $user->$userIdField }}"{{ request()->get('user') && request()->get('user') == $user->$userIdField ? ' selected':'' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        @if(in_array('method',explode(',', config('LaravelLogger.searchFields'))))
            <div class="col-12 col-sm-4 col-lg-2 mb-2">
                <select class="form-control" name="method">
                    <option value="">{{ trans('LaravelLogger::laravel-logger.dashboard.search.all') }}</option>
                    @foreach(explode(' ','CONNECT DELETE GET OPTIONS PATCH POST PUT TRACE') as $val)
                        <option value="{{ $val }}"{{ request()->get('method') && request()->get('method') == $val ? ' selected':''}}>{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        @if(in_array('route',explode(',', config('LaravelLogger.searchFields'))))
            <div class="col-12 col-sm-4 col-lg-2 mb-2">
                <input type="text" name="route" class="form-control" value="{{request()->get('route') ? request()->get('route'):null}}" placeholder="{{ trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.route') }}">
            </div>
        @endif
        @if(in_array('ip',explode(',', config('LaravelLogger.searchFields'))))
            <div class="col-12 col-sm-4 col-lg-2 mb-2">
                <input type="text" name="ip_address" class="form-control" value="{{request()->get('ip_address') ? request()->get('ip_address'):null}}" placeholder="{{ trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.ip') }}">
            </div>
        @endif
        @if(in_array('description',explode(',', config('LaravelLogger.searchFields')))||in_array('user',explode(',', config('LaravelLogger.searchFields'))) ||in_array('method',explode(',', config('LaravelLogger.searchFields'))) || in_array('route',explode(',', config('LaravelLogger.searchFields'))) || in_array('ip',explode(',', config('LaravelLogger.searchFields'))))
            <div class="col-12 col-sm-4 col-lg-2 mb-2">
                <input type="submit" class="btn btn-primary btn-block" value="{{ trans('LaravelLogger::laravel-logger.dashboard.search.search') }}">
            </div>
        @endif
    </div>
</form>
