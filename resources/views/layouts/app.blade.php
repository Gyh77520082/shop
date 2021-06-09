<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- title -->
        <title>@yield('title','shop') - 基础学习</title>
        <!-- styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="app" class="{{ route_class() }}-page">
            <!-- headers -->
            @include('layouts._header')
            <div class="container">
               @yield('content')
            </div>
            <!-- footer -->
            @include('layouts._footer')
        </div>
    </body>
    <!-- scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scriptsAfterJs')
   
</html>