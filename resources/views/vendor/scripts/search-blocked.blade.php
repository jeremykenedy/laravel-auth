<script>
    $(function() {
        var searchBlockFormContainer = $('#search_blocked_form');
        var cardTitle = $('#card_title');
        var blockedTableBody = $('.blocked-table-body');
        var resultsContainer = $('#search_results');
        var blockedCount = $('#blocked_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_blocked');
        var searchformInput = $('#blocked_search_box');
        var userPagination = $('#user_pagination');
        var searchSubmit = $('#search_trigger');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        searchBlockFormContainer.show();
        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html('');
            blockedTableBody.hide();
            clearSearchTrigger.show();
            var noResulsHtml = '<tr>' +
                                '<td>{!! trans("laravelblocker::laravelblocker.search.no-results") !!}</td>' +
                                '<td></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td class="hidden-sm hidden-xs hidden-md"></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>';

            @if($searchtype == 'normal')
                var searchUrl = "{{ route('laravelblocker::search-blocked') }}";
            @endif
            @if($searchtype == 'deleted')
                var searchUrl = "{{ route('laravelblocker::search-blocked-deleted') }}";
            @endif

            $.ajax({
                type:'POST',
                url: searchUrl,
                data: searchform.serialize(),
                success: function (result) {
                    var jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        $.each(jsonData, function(index, val) {
                            var rolesHtml = '';
                            var roleClass = '';


                            @if($searchtype == 'normal')
                                var showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="blocker/' + val.id + '" data-toggle="tooltip" title="{{ trans("laravelblocker::laravelblocker.tooltips.show") }}">{!! trans("laravelblocker::laravelblocker.buttons.show") !!}</a>';
                                var editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="blocker/' + val.id + '/edit" data-toggle="tooltip" title="{{ trans("laravelblocker::laravelblocker.tooltips.edit") }}">{!! trans("laravelblocker::laravelblocker.buttons.edit") !!}</a>';
                                var deleteCellHtml = '<form method="POST" action="/blocker/'+ val.id +'" accept-charset="UTF-8" data-toggle="tooltip" title="Delete Blocked Item">' +
                                        '{!! Form::hidden("_method", "DELETE") !!}' +
                                        '{!! csrf_field() !!}' +
                                        '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Blocked Item" data-message="{!! trans("laravelblocker::laravelblocker.modals.delete_blocked_message", ["blocked" => "'+val.name+'"]) !!}">' +
                                            '{!! trans("laravelblocker::laravelblocker.buttons.delete") !!}' +
                                        '</button>' +
                                    '</form>';
                            @endif
                            @if($searchtype == 'deleted')
                                var showCellHtml    ='Show';
                                var editCellHtml    ='Restore';
                                var deleteCellHtml  ='Destroy';
                            @endif

                            var userId = val.userId;
                            if (!userId) {
                                userId = "<span class='disabled'>";
                                    userId += "{!! trans('laravelblocker::laravelblocker.none') !!}";
                               userId += "</span>";
                            };

                            resultsContainer.append('<tr>' +
                                '<td>' + val.id + '</td>' +
                                '<td>' + val.type + '</td>' +
                                '<td>' + val.value + '</td>' +
                                '<td class="hidden-xs">' + val.note + '</td>' +
                                '<td class="hidden-xs hidden-sm">' + userId + '</td>' +
                                '<td class="hidden-xs hidden-sm hidden-md">' + val.created_at + '</td>' +
                                '<td class="hidden-xs hidden-sm hidden-md">' + val.updated_at + '</td>' +
                                @if($searchtype == 'deleted')
                                    '<td class="hidden-xs hidden-sm">' + val.deleted_at + '</td>' +
                                @endif
                                '<td>' + showCellHtml + '</td>' +
                                '<td>' + editCellHtml + '</td>' +
                                '<td>' + deleteCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    blockedCount.html(jsonData.length + " {!! trans('laravelblocker::laravelblocker.search.found-footer') !!}");
                    userPagination.hide();
                    @if($searchtype == 'normal')
                        cardTitle.html("{!! trans('laravelblocker::laravelblocker.search.title') !!}");
                    @endif
                    @if($searchtype == 'deleted')
                        cardTitle.html("{!! trans('laravelblocker::laravelblocker.search.title-deleted') !!}");
                    @endif
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        blockedCount.html(0 + " {!! trans('laravelblocker::laravelblocker.search.found-footer') !!}");
                        userPagination.hide();
                        @if($searchtype == 'normal')
                            cardTitle.html("{!! trans('laravelblocker::laravelblocker.search.title') !!}");
                        @endif
                        @if($searchtype == 'deleted')
                            cardTitle.html("{!! trans('laravelblocker::laravelblocker.search.title-deleted') !!}");
                        @endif
                    };
                },
            });
        });
        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });
        searchformInput.keyup(function(event) {
            if ($('#blocked_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                blockedTableBody.show();
                @if($searchtype == 'normal')
                    cardTitle.html("{!! trans('laravelblocker::laravelblocker.blocked-items-title') !!}");
                @endif
                @if($searchtype == 'deleted')
                    cardTitle.html("{!! trans('laravelblocker::laravelblocker.blocked-items-deleted-title') !!}");
                @endif
                userPagination.show();
                blockedCount.html("{!! trans_choice('laravelblocker::laravelblocker.blocked-table.caption', 1, ['blockedcount' => $blocked->count()]) !!}");
            };
        });
        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            blockedTableBody.show();
            resultsContainer.html('');
            searchformInput.val('');
            @if($searchtype == 'normal')
                cardTitle.html("{!! trans('laravelblocker::laravelblocker.blocked-items-title') !!}");
            @endif
            @if($searchtype == 'deleted')
                cardTitle.html("{!! trans('laravelblocker::laravelblocker.blocked-items-deleted-title') !!}");
            @endif
            userPagination.show();
            blockedCount.html("{!! trans_choice('laravelblocker::laravelblocker.blocked-table.caption', 1, ['blockedcount' => $blocked->count()]) !!}");
        });
    });
</script>
