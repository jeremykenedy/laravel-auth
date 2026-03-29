<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
        <form method="POST" action="{{ route('search-users') }}" role="form" class="needs-validation" id="search_users">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="user_search_box" id="user_search_box" class="form-control" placeholder="{{ trans('laravelusers::forms.search-users-ph') }}" aria-label="{{ trans('laravelusers::forms.search-users-ph') }}">
                <div class="input-group-append">
                    <a href="#" class="btn btn-warning clear-search" data-toggle="tooltip" title="{!! trans('laravelusers::laravelusers.tooltips.clear-search') !!}">
                        @if(config('laravelusers.fontAwesomeEnabled'))
                            <i class="fas fa-times" aria-hidden="true"></i>
                            <span class="sr-only">
                                {!! trans('laravelusers::laravelusers.tooltips.clear-search') !!}
                            </span>
                        @else
                            {!! trans('laravelusers::laravelusers.tooltips.clear-search') !!}
                        @endif
                    </a>
                    @if(config('laravelusers.fontAwesomeEnabled'))
                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="{{ trans('laravelusers::laravelusers.tooltips.submit-search') }}">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('laravelusers::laravelusers.tooltips.submit-search') }}</span>
                        </button>
                    @else
                        <button type="submit" class="btn btn-secondary" title="{{ trans('laravelusers::laravelusers.tooltips.submit-search') }}">
                            {!! trans('laravelusers::laravelusers.tooltips.submit-search') !!}
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

