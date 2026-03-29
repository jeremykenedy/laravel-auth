<div {{ $attributes->merge(['class' => 'relative inline-flex']) }}>
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt ?? '' }}" class="{{ $sizeClasses() }} {{ $rounded ? 'rounded-full' : 'rounded-lg' }} object-cover" loading="lazy" />
    @else
        <span class="{{ $sizeClasses() }} {{ $rounded ? 'rounded-full' : 'rounded-lg' }} inline-flex items-center justify-center bg-gray-200 dark:bg-gray-600 font-medium text-gray-600 dark:text-gray-300">
            {{ $computedInitials() }}
        </span>
    @endif
    @if($status)
        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white dark:ring-gray-800 {{ match($status) { 'online' => 'bg-green-500', 'away' => 'bg-amber-500', 'busy' => 'bg-red-500', default => 'bg-gray-400' } }}"></span>
    @endif
</div>
