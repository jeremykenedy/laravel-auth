<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
        {{ html()->form('POST', route('search-users'))
                ->attribute('role', 'form')
                ->class('needs-validation')
                ->id('search_users')
                ->open() }}
            @csrf
            <div class="input-group mb-3">
                {{ html()->text('user_search_box')
                        ->id('user_search_box')
                        ->class('form-control')
                        ->placeholder(trans('usersmanagement.search.search-users-ph'))
                        ->attribute('aria-label', trans('usersmanagement.search.search-users-ph')) }}
                <div class="input-group-append">
                    <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="{{ trans('usersmanagement.tooltips.clear-search') }}" style="display:none;">
                        <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!! trans('usersmanagement.tooltips.clear-search') !!}
                        </span>
                    </a>
                    <a href="#" class="input-group-addon btn btn-secondary" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="{{ trans('usersmanagement.tooltips.submit-search') }}" >
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!!  trans('usersmanagement.tooltips.submit-search') !!}
                        </span>
                    </a>
                </div>
            </div>
        {{ html()->form()->close() }}
    </div>
</div>
