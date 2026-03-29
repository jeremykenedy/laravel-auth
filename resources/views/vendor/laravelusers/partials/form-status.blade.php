@if (session('message'))
    <div class="alert alert-primary alert-dismissable">
        <h4>
            <i aria-hidden="true" class="icon fa fa-info-circle fa-fw"></i>
        </h4>
        <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
        {{ session('message') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissable">
        <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
        <h4>
            <i aria-hidden="true" class="icon fa fa-check fa-fw"></i> Success
        </h4>{{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissable" role="alert">
        <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
        <h4 class="alert-heading">
            <i aria-hidden="true" class="fas fa-exclamation-triangle fa-fw"></i>
            Error
        </h4>
        <hr>
        <p class="mb-0">
            {{ session('error') }}
        </p>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-light alert-dismissable">
        <a aria-label="close" class="close" data-dismiss="alert" href="#">&times;</a>
        <h4 class="alert-heading text-danger">
            <i aria-hidden="true" class="fas fa-exclamation-triangle fa-fw"></i>
            <strong>
                Errors
            </strong>
        </h4>
        <ul class="list-group list-group-flush">
            @foreach ($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
