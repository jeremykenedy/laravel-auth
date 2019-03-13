<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Blocker Blades Language Lines - laravelblocker
    |--------------------------------------------------------------------------
    */

    'blocked-items-title'           => 'Blocked Items',
    'blocked-item-title'            => 'Blocked Item: <strong>:name</strong>',
    'blocked-item-deleted-title'    => 'Deleted Blocked Item: <strong>:name</strong>',
    'edit-blocked-item-title'       => 'Editing Item: <strong>:name</strong>',
    'blocked-items-deleted-title'   => 'Deleted Blocked Items',

    'na'                        => 'N/A',
    'none'                      => 'None',

    'titles' => [
        'show-blocked'      => 'Blocked Items',
        'show-blocked-item' => 'Blocked Item',
        'create-blocked'    => 'Create Blocked Item',
    ],

    'buttons' => [
        'create-new-blocked'        => 'Create New',
        'show-deleted-blocked'      => 'Show Deleted',
        'back-to-blocked'           => 'Back to Blocked',
        'back-to-blocked-deleted'   => '<span class="hidden-xs">Back</span> <span class="hidden-xs hidden-sm">to Deleted</span>',
        'show'                      => '<span class="hidden-xs hidden-sm">Show </span><i class="fa fa-eye fa-fw" aria-hidden="true"></i>',
        'edit'                      => '<span class="hidden-xs hidden-sm">Edit </span><i class="fa fa-pencil fa-fw" aria-hidden="true"></i>',
        'delete'                    => '<span class="hidden-xs hidden-sm">Delete </span><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>',
        'destroy'                   => '<span class="hidden-xs hidden-sm">Destroy </span><i class="fa fa-trash fa-fw" aria-hidden="true"></i>',
        'save-larger'               => 'Save Edits <i class="fa fa-save fa-fw" aria-hidden="true"></i>',
        'create-larger'             => 'Create New Blocked Item <i class="fa fa-save fa-fw" aria-hidden="true"></i>',
        'show-larger'               => 'Show <i class="fa fa-eye fa-fw" aria-hidden="true"></i>',
        'edit-larger'               => 'Edit <i class="fa fa-pencil fa-fw" aria-hidden="true"></i>',
        'delete-larger'             => 'Delete <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>',
        'destroy-larger'            => 'Destroy <i class="fa fa-trash fa-fw" aria-hidden="true"></i>',
        'destroy-all'               => '{1} Destroy :count Blocked Item|[2,*] Destroy All :count Blocked Items',
        'restore-all-blocked'       => '{1} Restore :count Blocked Item|[2,*] Restore All :count Blocked Items',
        'restore-blocked-item'      => '<span class="hidden-xs hidden-sm">Restore </span><i class="fa fa-fw fa-history" aria-hidden="true"></i>',
        'restore-blocked-item-full' => 'Restore <i class="fa fa-fw fa-history" aria-hidden="true"></i>',
    ],

    'tooltips' => [
        'delete'                    => 'Delete Blocked Item',
        'show'                      => 'Show Blocked Item',
        'edit'                      => 'Edit Blocked Item',
        'create-new'                => 'Create New Blocked',
        'back-blocked'              => 'Back to blocked',
        'back-blocked-deleted'      => 'Back to deleted blocked',
        'submit-search'             => 'Submit Blocked Search',
        'clear-search'              => 'Clear Search Results',
        'destroy_blocked_tooltip'   => 'Destroy Blocked Item',
        'restoreItem'               => 'Restore Blocked Item',
    ],

    'blocked-table' => [
        'caption'   => '{1} :blockedcount block total|[2,*] :blockedcount total blocks',
        'id'        => 'ID',
        'type'      => 'Type',
        'value'     => 'Value',
        'note'      => 'Note',
        'userId'    => 'UserID',
        'createdAt' => 'Created',
        'updatedAt' => 'Updated',
        'deletedAt' => 'Deleted',
        'actions'   => 'Actions',
        'none'      => 'No Blocked Items',
    ],

    'forms' => [
        'search-blocked-ph' => 'Search Blocked',
        'blockedTypeLabel'  => 'Blocked Type',
        'blockedTypeSelect' => 'Select Blocked Type',
        'blockedValueLabel' => 'Blocked Value',
        'blockedValuePH'    => 'Blocked Value',
        'blockedNoteLabel'  => 'Blocked Note',
        'blockedNotePH'     => 'Type Blocked Note',
        'blockedUserLabel'  => 'Blocked User',
        'blockedUserSelect' => 'Select Blocked User',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'title-deleted'     => 'Showing Deleted Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-users-ph'   => 'Search Blocked',
        'required'          => 'Search term is required',
        'string'            => 'Search term has invalid characters',
        'max'               => 'Search term has too many characters - 255 allowed',
    ],

    'modals' => [
        'delete_blocked_title'          => 'Delete blocked item',
        'destroy_blocked_title'         => 'Destroy Blocked Item',
        'delete_blocked_message'        => 'Are you sure you want to delete :blocked?',
        'destroy_blocked_message'       => 'Are you sure you want to DESTROY :blocked?',
        'delete_blocked_btn_cancel'     => 'Cancel',
        'delete_blocked_btn_confirm'    => 'Confirm Delete',
        'destroy_all_blocked_title'     => 'Destroy ALL Blocked Items',
        'destroy_all_blocked_message'   => 'Are you sure you want to DESTROY ALL blocked items?',
        'resotreAllBlockedTitle'        => 'Restore ALL Blocked Items',
        'resotreAllBlockedMessage'      => 'Are you sure you want to RESTORE ALL blocked items?',
        'resotreBlockedItemTitle'       => 'Restore Blocked Item',
        'resotreBlockedItemMessage'     => 'Are you sure you want to RESTORE :value?',
        'btnConfirm'                    => 'Confirm',
        'btnCancel'                     => 'Cancel',
    ],

    'messages' => [
        'blocked-creation-success'  => 'Successfully created blocked item.',
        'delete-success'            => 'Successfully deleted blocked item.',
        'update-success'            => 'Successfully updated blocked item.',
        'successRestoredItem'       => 'Successfully restored blocked item.',
        'successRestoredAllItems'   => 'Successfully restored all blocked items.',
        'successDestroyedItem'      => 'Successfully destroyed blocked item.',
        'successDestroyedAllItems'  => 'Successfully destroyed all blocked items.',
    ],

    'validation' => [
        'blockedTypeRequired'   => 'Blocked Type is required.',
        'blockedValueRequired'  => 'Blocked Value is required.',
        'blockedExists'         => 'The :attribute already exists.',
        'email'                 => 'Must be a valid formed email address.',
    ],

    'errors' => [
        'errorBlockerNotFound' => 'Blocked item not found.',
    ],

    'flash-messages' => [
        'close'         => 'Close',
        'success'       => 'Success',
        'error'         => 'Error',
        'whoops'        => 'Whoops! ',
        'someProblems'  => 'There were some problems with your input.',

    ],

];
