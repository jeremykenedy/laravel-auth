<?php

namespace Spatie\Health\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Spatie\Health\Enums\Status;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResult;

class StatusIndicator extends Component
{
    public function __construct(public StoredCheckResult $result) {}

    public function render(): View
    {
        return view('health::status-indicator', [
            'result' => $this->result,
            'backgroundColor' => fn (string $status) => $this->getBackgroundColor($status),
            'iconColor' => fn (string $status) => $this->getIconColor($status),
            'icon' => fn (string $status) => $this->getIcon($status),
        ]);
    }

    protected function getBackgroundColor(string $status): string
    {
        return match ($status) {
            Status::ok()->value => 'md:bg-emerald-100 md:dark:bg-emerald-800',
            Status::warning()->value => 'md:bg-yellow-100  md:dark:bg-yellow-800',
            Status::skipped()->value => 'md:bg-blue-100  md:dark:bg-blue-800',
            Status::failed()->value, Status::crashed()->value => 'md:bg-red-100  md:dark:bg-red-800',
            default => 'md:bg-gray-100 md:dark:bg-gray-600'
        };
    }

    protected function getIconColor(string $status): string
    {
        return match ($status) {
            Status::ok()->value => 'text-emerald-500',
            Status::warning()->value => 'text-yellow-500',
            Status::skipped()->value => 'text-blue-500',
            Status::failed()->value, Status::crashed()->value => 'text-red-500',
            default => 'text-gray-500'
        };
    }

    protected function getIcon(string $status): string
    {
        return match ($status) {
            Status::ok()->value => 'check-circle',
            Status::warning()->value => 'exclamation-circle',
            Status::skipped()->value => 'arrow-circle-right',
            Status::failed()->value, Status::crashed()->value => 'x-circle',
            default => ''
        };
    }
}
