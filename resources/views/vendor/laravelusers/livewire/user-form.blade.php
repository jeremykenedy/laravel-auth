<div>
    <x-ui::card>
        <x-slot name="header">
            <h3>{{ $userId ? 'Edit User' : 'Create User' }}</h3>
        </x-slot>

        @if(session('success'))
            <x-ui::alert variant="success">{{ session('success') }}</x-ui::alert>
        @endif

        <form wire:submit="save">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" />
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" />
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" wire:model="first_name" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" wire:model="last_name" class="form-control" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Password {{ $userId ? '(leave blank to keep)' : '' }}</label>
                    <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" />
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" wire:model="password_confirmation" class="form-control" />
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select wire:model="role" class="form-select @error('role') is-invalid @enderror">
                    <option value="">Select role...</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ url('/users') }}" class="btn btn-outline-secondary" wire:navigate>Cancel</a>
                <button type="submit" class="btn btn-primary">{{ $userId ? 'Update User' : 'Create User' }}</button>
            </div>
        </form>
    </x-ui::card>
</div>
