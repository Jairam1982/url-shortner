<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css'])
    
</head>
<body>

    @include('layouts.header')

    <div class="content">
        @yield('content')
    </div>

    @include('layouts.footer')

</body>
</html>