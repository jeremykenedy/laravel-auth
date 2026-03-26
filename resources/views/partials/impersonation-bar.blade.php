@if(session('impersonator_id'))
<div class="sticky top-0 z-50 bg-amber-500 text-amber-950 text-sm font-medium px-4 py-2 text-center">
    <span>You are impersonating <strong>{{ Auth::user()->name }}</strong> (logged in as {{ session('impersonator_name') }}).</span>
    <form method="POST" action="{{ route('impersonate.stop') }}" class="inline">
        @csrf
        <button type="submit" class="ml-2 underline font-bold hover:no-underline">Stop Impersonating</button>
    </form>
</div>
@endif
