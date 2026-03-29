<div>
    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search users..." class="form-control" />
    </div>

    @if(session('success'))
        <x-ui::alert variant="success">{{ session('success') }}</x-ui::alert>
    @endif

    @if(count($selected) > 0)
        <div class="mb-3 p-3 border rounded bg-light">
            <span class="fw-medium">{{ count($selected) }} user(s) selected</span>
            <div class="d-inline-flex gap-2 ms-3">
                <select wire:model="bulkAction" class="form-select form-select-sm d-inline-block w-auto">
                    <option value="">Choose action...</option>
                    <option value="delete">Delete</option>
                    <option value="activate">Activate</option>
                    <option value="deactivate">Deactivate</option>
                    <option value="change_role">Change Role</option>
                </select>
                @if($bulkAction === 'change_role')
                    <select wire:model="bulkRole" class="form-select form-select-sm d-inline-block w-auto">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                @endif
                <button wire:click="bulkApply" wire:confirm="Apply bulk action to {{ count($selected) }} user(s)?" class="btn btn-primary btn-sm">Apply</button>
                <button wire:click="$set('selected', [])" class="btn btn-link btn-sm">Clear</button>
            </div>
        </div>
    @endif

    <x-ui::card>
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width:40px"><input type="checkbox" wire:click="toggleSelectAll($event.target.checked)" class="form-check-input" /></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr wire:key="user-{{ $user->id }}">
                        <td>
                            @if($user->id !== auth()->id())
                                <input type="checkbox" wire:model.live="selected" value="{{ $user->id }}" class="form-check-input" />
                            @endif
                        </td>
                        <td>{{ $user->id }}</td>
                        <td class="fw-medium">
                            <a href="{{ url('users/'.$user->id) }}" wire:navigate>{{ $user->name }}</a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'" size="sm">{{ $role->name }}</x-ui::badge>
                            @endforeach
                        </td>
                        <td class="text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ url('users/'.$user->id) }}" class="btn btn-success btn-sm" wire:navigate>Show</a>
                            <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-info btn-sm" wire:navigate>Edit</a>
                            @if($user->id !== auth()->id())
                                <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Delete {{ $user->name }}?" class="btn btn-danger btn-sm">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">{{ $users->links() }}</div>
    </x-ui::card>
</div>
