{!! Form::open([
    'route' => ['laravelblocker::blocker.destroy', $blockedItem->id],
    'method' => 'DELETE',
    'accept-charset' => 'UTF-8',
    'data-toggle' => 'tooltip',
    'title' => trans('laravelblocker::laravelblocker.tooltips.delete')
]) !!}
    {!! Form::hidden("_method", "DELETE") !!}
    {!! csrf_field() !!}
    <button class="btn btn-danger btn-sm btn-block" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Blocked Item" data-message="{!! trans("laravelblocker::laravelblocker.modals.delete_blocked_message", ["blocked" => $blockedItem->value]) !!}">
        {!! trans("laravelblocker::laravelblocker.buttons.delete") !!}
    </button>
{!! Form::close() !!}
