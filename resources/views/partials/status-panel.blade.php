@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
    <div class="card card-danger text-xs-center z-depth-2">
        <div class="card-block">
            <p class="white-text">{{ session()->get('message') }}</p>
        </div>
    </div>
    @else
    <div class="card card-success text-xs-center z-depth-2">
        <div class="card-block">
            <p class="white-text">{{ session()->get('message') }}</p>
        </div>
    </div>
    @endif
@endif