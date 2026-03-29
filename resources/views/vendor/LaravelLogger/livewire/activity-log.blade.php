<div>
    <div class="mb-3">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search activity..." class="form-control" />
    </div>

    <x-ui::card title="Activity Log">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Route</th>
                    <th>Method</th>
                    <th>IP</th>
                    <th>User</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr wire:key="activity-{{ $activity->id }}">
                        <td>{{ $activity->description }}</td>
                        <td class="small text-muted">{{ $activity->route }}</td>
                        <td><x-ui::badge :variant="$activity->methodType === 'GET' ? 'info' : 'success'" size="sm">{{ $activity->methodType }}</x-ui::badge></td>
                        <td class="small text-muted">{{ $activity->ipAddress }}</td>
                        <td>{{ $activity->userId }}</td>
                        <td class="small text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No activity recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">{{ $activities->links() }}</div>
    </x-ui::card>
</div>
