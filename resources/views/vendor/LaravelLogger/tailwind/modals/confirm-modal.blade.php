@php
    $confirmVariant = $modalClass ?? 'primary';
    $variantMap = [
        'danger' => 'danger',
        'success' => 'success',
        'warning' => 'warning',
        'info' => 'info',
    ];
    $confirmVariant = $variantMap[$confirmVariant] ?? 'primary';
@endphp

<x-ui::confirm
    :id="$formTrigger"
    :variant="$confirmVariant"
    :title="trans('LaravelLogger::laravel-logger.modals.shared.btnConfirm')"
    :message="trans('LaravelLogger::laravel-logger.modals.shared.btnConfirm')"
    :confirm-text="$btnSubmitText ?? trans('LaravelLogger::laravel-logger.modals.shared.btnConfirm')"
    :cancel-text="trans('LaravelLogger::laravel-logger.modals.shared.btnCancel')"
/>
