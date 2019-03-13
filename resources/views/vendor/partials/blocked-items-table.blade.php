<div class="table-responsive blocked-table">
    <table class="table table-sm table-striped data-table">
        <caption id="blocked_count">
            {!! trans_choice('laravelblocker::laravelblocker.blocked-table.caption', 1, ['blockedcount' => $blocked->count()]) !!}
        </caption>
        <thead class="thead">
            <tr>
                <th scope="col">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.id') !!}
                </th>
                <th scope="col">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.type') !!}
                </th>
                <th scope="col">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.value') !!}
                </th>
                <th scope="col" class="hidden-xs">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.note') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.userId') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm hidden-md">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.createdAt') !!}
                </th>
                <th scope="col" class="hidden-xs hidden-sm hidden-md">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.updatedAt') !!}
                </th>
                @if($tabletype == 'deleted')
                    <th scope="col" class="hidden-xs hidden-sm">
                        {!! trans('laravelblocker::laravelblocker.blocked-table.deletedAt') !!}
                    </th>
                @endif
                <th class="no-search no-sort" colspan="3">
                    {!! trans('laravelblocker::laravelblocker.blocked-table.actions') !!}
                </th>
            </tr>
        </thead>
        <tbody class="blocked-table-body">
            @if($blocked->count() > 0)
                @foreach($blocked as $blockedItem)
                    <tr>
                        <td>
                            {!! $blockedItem->id !!}
                        </td>
                        <td>
                            {!! $blockedItem->blockedType->slug !!}
                        </td>
                        <td>
                            {!! $blockedItem->value !!}
                        </td>
                        <td class="hidden-xs">
                            {!! $blockedItem->note !!}
                        </td>
                        <td class="hidden-xs hidden-sm">
                            @if ($blockedItem->userId)
                                {!! $blockedItem->userId !!}
                            @else
                                <span class="disabled">
                                    {!! trans('laravelblocker::laravelblocker.none') !!}
                                </span>
                            @endif
                        </td>
                        <td class="hidden-xs hidden-sm hidden-md">
                            {!! $blockedItem->created_at->format('m/d/Y H:ia') !!}
                        </td>
                        <td class="hidden-xs hidden-sm hidden-md">
                            {!! $blockedItem->updated_at->format('m/d/Y H:ia') !!}
                        </td>
                        @if($tabletype == 'deleted')
                            <td class="hidden-xs hidden-sm">
                                {!! $blockedItem->deleted_at->format('m/d/Y H:ia') !!}
                            </td>
                        @endif
                        @if($tabletype == 'normal')
                            <td>
                                <a class="btn btn-sm btn-info btn-block text-white" href="/blocker/{{ $blockedItem->id }}" data-toggle="tooltip" title="{{ trans("laravelblocker::laravelblocker.tooltips.show") }}">
                                    {!! trans("laravelblocker::laravelblocker.buttons.show") !!}
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning btn-block text-white" href="/blocker/{{ $blockedItem->id }}/edit" data-toggle="tooltip" title="{{ trans("laravelblocker::laravelblocker.tooltips.edit") }}">
                                    {!! trans("laravelblocker::laravelblocker.buttons.edit") !!}
                                </a>
                            </td>
                            <td>
                                @include('laravelblocker::forms.delete-sm')
                            </td>
                        @endif
                        @if($tabletype == 'deleted')
                            <td>
                                <a class="btn btn-sm btn-info btn-block text-white" href="/blocker-deleted/{{ $blockedItem->id }}" data-toggle="tooltip" title="{{ trans("laravelblocker::laravelblocker.tooltips.show") }}">
                                    {!! trans("laravelblocker::laravelblocker.buttons.show") !!}
                                </a>
                            </td>
                            <td>
                                @include('laravelblocker::forms.restore-item', ['restoreType' => 'small'])
                            </td>
                            <td>
                                @include('laravelblocker::forms.destroy-sm')
                            </td>
                        @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{!! trans("laravelblocker::laravelblocker.blocked-table.none") !!}</td>
                    <td></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs hidden-md"></td>
                    <td class="hidden-sm hidden-xs hidden-md"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        </tbody>
        @if(config('laravelblocker.enableSearchBlocked'))
            <tbody id="search_results"></tbody>
        @endif
    </table>
    @if(config('laravelblocker.blockerPaginationEnabled'))
        <div id="blocked_pagination">
            {{ $blocked->links() }}
        </div>
    @endif
</div>
