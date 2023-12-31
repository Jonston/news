<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @include('cabinet.navbar')
    <div class="container-fluid p-4">
        @yield('content')
    </div>
</head>
<body>
@vite('resources/js/app.js')
@yield('scripts')
</body>
</html>
