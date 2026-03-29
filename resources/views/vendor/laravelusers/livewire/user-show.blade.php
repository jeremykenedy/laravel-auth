<div>
    <x-ui::card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ $user->name }}</h3>
                <div class="d-flex gap-2">
                    <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-info btn-sm" wire:navigate>Edit</a>
                    <a href="{{ url('/users') }}" class="btn btn-outline-secondary btn-sm" wire:navigate>Back</a>
                </div>
            </div>
        </x-slot>

        <div class="row">
            <div class="col-md-3 text-center">
                <x-avatar :src="$user->profile?->avatar ?? null" :alt="$user->name" size="2xl" />
            </div>
            <div class="col-md-9">
                <dl class="row mb-0">
                    <dt class="col-sm-3 text-muted">ID</dt>
                    <dd class="col-sm-9">{{ $user->id }}</dd>
                    <dt class="col-sm-3 text-muted">Username</dt>
                    <dd class="col-sm-9 fw-bold">{{ $user->name }}</dd>
                    <dt class="col-sm-3 text-muted">Email</dt>
                    <dd class="col-sm-9">{{ $user->email }}</dd>
                    <dt class="col-sm-3 text-muted">First Name</dt>
                    <dd class="col-sm-9">{{ $user->first_name }}</dd>
                    <dt class="col-sm-3 text-muted">Last Name</dt>
                    <dd class="col-sm-9">{{ $user->last_name }}</dd>
                    <dt class="col-sm-3 text-muted">Role(s)</dt>
                    <dd class="col-sm-9">
                        @foreach($user->roles as $role)
                            <x-ui::badge :variant="$role->name === 'Admin' ? 'warning' : 'primary'">{{ $role->name }}</x-ui::badge>
                        @endforeach
                    </dd>
                    <dt class="col-sm-3 text-muted">Created</dt>
                    <dd class="col-sm-9">{{ $user->created_at->format('M d, Y g:i A') }}</dd>
                </dl>
            </div>
        </div>
    </x-ui::card>
</div>
