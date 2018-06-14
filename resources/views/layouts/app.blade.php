<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @stack('scripts')
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/bootstrap-4.0.0-beta.1.css')}}" type="text/css">
    <script defer src="{{asset('js/all.js')}}"></script>
    @stack('styles')
</head>
<body>
    <div id="app">
        @include('includes.navbar.navbar')
        <main class="">
            @yield('content')
        </main>
    </div>
    @include('includes.footer.footer')

    <!-- Scripts -->
    <!--script src="{{ asset('js/app.js') }}"></script-->
</body>
</html>
