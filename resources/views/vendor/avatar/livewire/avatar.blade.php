@php $sizes = ['xs'=>'h-6 w-6','sm'=>'h-8 w-8','md'=>'h-10 w-10','lg'=>'h-12 w-12','xl'=>'h-16 w-16','2xl'=>'h-20 w-20']; @endphp
<div class="relative inline-flex">
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="{{ $sizes[$size] ?? $sizes['md'] }} rounded-full object-cover" />
    @else
        <span class="{{ $sizes[$size] ?? $sizes['md'] }} rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 font-medium text-sm">{{ strtoupper(substr($alt, 0, 2)) }}</span>
    @endif
    @if($status)
        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white dark:ring-gray-800 {{ $status === 'online' ? 'bg-green-400' : ($status === 'away' ? 'bg-amber-400' : 'bg-gray-300') }}"></span>
    @endif
</div>
