<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
                font-size: 84px;
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
        </style>
    </head>
    <body>
        <div class="container">
            <br/>
         
            <br/>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Import Export data in csv File</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('import')}} " method= "POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" name="file" accept=".csv" value="">
                    <br>

                    <button class="btn btn-success">Import User Data</button>

                    <a class="btn btn-warning" href="{{route('export')}}">Export User Data</a>
                </form>
                    @yield('csv_data')
                </div>
            </div>

        </div>
    </body>
</html>
