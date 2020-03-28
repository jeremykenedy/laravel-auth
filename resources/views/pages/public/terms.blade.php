<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Auth | {{ trans('terms.publicPage.title') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
            }

            .title small {
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .container {
                max-width: 600px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    {{ trans('terms.publicPage.title') }}
                </div>
                <div class="container">
                    <p>
                        {{ trans('terms.publicPage.term1') }}
                    </p>
                    <p>
                        {{ trans('terms.publicPage.term2') }}
                    </p>
                    <p>
                        {{ trans('terms.publicPage.term3') }}
                    </p>
                    <p>
                        {{ trans('terms.publicPage.term4') }}
                    </p>
                    <p>
                        {{ trans('terms.publicPage.term5') }}
                    </p>
                    <p>
                        {{ trans('terms.publicPage.term6') }}
                    </p>
                    <p>
                        {{ trans('terms.publicPage.term7') }}
                    </p>
                    <p>
                        {{ trans('terms.publicPage.term8') }}
                    </p>
                </div>

            </div>
        </div>
    </body>
</html>
