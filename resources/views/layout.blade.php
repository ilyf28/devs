<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Laravel</title>
    </head>
    <body>
        <div style="float: right;">
            @include('sidebar')
        </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>