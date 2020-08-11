<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }}<br><p style="margin-top: 0px; font-size: 28px;">Company Dashboard</p>
                </div>
                <div>
                    <input type="text" id="vendor" placeholder="company-url" style="text-align: center;" />.{{ config('app.domain') }}<br>
                    <button id="goButton" style="display: inline-block; margin-top: 10px;">Go</button>
                    <button id="registerButton" style="display: inline-block; margin-top: 10px;">Register</button>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('goButton').onclick = function() {
                var vendor = document.getElementById('vendor').value;
                window.location.href = '//' + vendor + '.{{ config('app.domain') }}';
            };

            document.getElementById('registerButton').onclick = function() {
                var vendor = document.getElementById('vendor').value;
                window.location.href = '{{ route('register') }}';
            };
        </script>
    </body>
</html>
