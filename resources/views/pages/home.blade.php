@extends('layouts.app')

@section('content')

    @include('partials.status-panel')

    <div class="container">

        <p><b>Unlimited</b> number of social providers via Socialite package. Live Demo uses:</p>
        <p style="margin-bottom:15px;">
        <span class="tag green">Facebook</span>
        <span class="tag green">Twitter</span>
        <span class="tag green">Google+</span>
        <span class="tag green">GitHub</span>
        </p>

        <div class="headline">
            <h2>Adding new Social provider easy as copy/paste login button</h2>
        </div>

        <p>Checkout example file where you add new buttons:</p>

        <script src="https://gist.github.com/ivanderbu2/a3703b455981521e79add5bdead4b6d1.js"></script>

        <p>After this you only need to add OAuth keys to <code>services.php</code> config file:</p>

        <script src="https://gist.github.com/ivanderbu2/fae7d5d42a08053099d7fdb63d9c24bd.js"></script>

        <p><a class="btn btn-primary btn-lg" href="{{url('register')}}" role="button">Try Register Feature</a></p>

        <p>If you have any improvements or ideas please post comments here: <a href="https://tuts.codingo.me/laravel-social-and-email-authentication#disqus_thread">Laravel 5.3 Social and Email Multi-Authentication</a></p>
    </div>

@endsection