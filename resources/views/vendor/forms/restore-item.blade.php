@if($restoreType == 'full')
    @php
        $itemId = $item->id;
        $itemValue = $item->value;
        $itemClasses = 'btn btn-success btn-block';
        $itemText = trans('laravelblocker::laravelblocker.buttons.restore-blocked-item-full');
    @endphp
@endif
@if($restoreType == 'small')
    @php
        $itemId = $blockedItem->id;
        $itemValue = $blockedItem->value;
        $itemClasses = 'btn btn-sm btn-success btn-block';
        $itemText = trans('laravelblocker::laravelblocker.buttons.restore-blocked-item');
    @endphp
@endif

{!! Form::open([
    'route' => ['laravelblocker::blocker-item-restore', $itemId],
    'method' => 'PUT',
    'accept-charset' => 'UTF-8',
    'data-toggle' => 'tooltip',
    'title' => trans("laravelblocker::laravelblocker.tooltips.restoreItem")
]) !!}
    {!! Form::hidden("_method", "PUT") !!}
    {!! csrf_field() !!}
    {!! Form::button($itemText, [
            'type' => 'button',
            'class' => $itemClasses,
            'data-toggle' => 'modal',
            'data-target' => '#confirmRestore',
            'data-title' => trans('laravelblocker::laravelblocker.modals.resotreBlockedItemTitle'),
            'data-message' => trans('laravelblocker::laravelblocker.modals.resotreBlockedItemMessage', ['value' => $itemValue])
        ]) !!}
{!! Form::close() !!}
