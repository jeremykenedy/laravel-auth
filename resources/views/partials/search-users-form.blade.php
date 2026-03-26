{{-- User search form - uses ui-kit search input component --}}
<div class="flex justify-end mb-4">
    <div class="w-full sm:w-80">
        <form method="POST" action="{{ route('search-users') }}" id="search_users">
            @csrf
            <x-ui::search-input name="user_search_box" placeholder="{{ trans('usersmanagement.search.search-users-ph') }}" />
        </form>
    </div>
</div>
