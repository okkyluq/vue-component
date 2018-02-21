<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}"> 
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('vue-shop/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vue-shop/heroic-features.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="app">
            {{-- @include('nav') --}}
            {{-- <my-nav></my-nav> --}}
            <router-view></router-view>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
