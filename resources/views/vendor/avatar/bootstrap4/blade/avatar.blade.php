@php
$px = match($size) { 'xs'=>'24px','sm'=>'32px','md'=>'40px','lg'=>'48px','xl'=>'64px','2xl'=>'80px',default=>'40px' };
$fs = match($size) { 'xs'=>'.65rem','sm'=>'.75rem','md'=>'.85rem','lg'=>'1rem','xl'=>'1.25rem','2xl'=>'1.5rem',default=>'.85rem' };
@endphp
<div class="d-inline-flex align-items-center position-relative {{ $attributes->get('class', '') }}">
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt ?? '' }}" class="rounded{{ $rounded ? '-circle' : '' }} object-fit-cover" style="width:{{ $px }};height:{{ $px }}" loading="lazy" />
    @else
        <span class="d-inline-flex align-items-center justify-content-center rounded{{ $rounded ? '-circle' : '' }} bg-secondary bg-opacity-25 text-secondary fw-medium" style="width:{{ $px }};height:{{ $px }};font-size:{{ $fs }}">
            {{ $computedInitials() }}
        </span>
    @endif
    @if($status)
        <span class="position-absolute bottom-0 end-0 d-block rounded-circle border border-2 border-white {{ match($status) { 'online'=>'bg-success','away'=>'bg-warning','busy'=>'bg-danger',default=>'bg-secondary' } }}" style="width:10px;height:10px"></span>
    @endif
</div>
