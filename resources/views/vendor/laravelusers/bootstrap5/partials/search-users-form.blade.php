{{-- User search form - Bootstrap 5 --}}
<div class="d-flex justify-content-end mb-3">
    <div class="col-12 col-sm-auto" style="min-width: 300px;">
        <form method="POST" action="{{ route('search-users') }}" id="search_users">
            @csrf
            <x-ui::search-input name="user_search_box" placeholder="{{ trans('usersmanagement.search.search-users-ph') }}" />
        </form>
    </div>
</div>
