@if(config('laravelblocker.blockerFlashMessagesEnabled'))
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @include('laravelblocker::partials.form-status')
            </div>
        </div>
    </div>
@endif
