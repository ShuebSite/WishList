<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- <link rel="stylesheet" href="/css/app.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- @vite('resources/sass/app.scss') -->
    <script src="/js/app.js" defer></script>
</head>
<body>
    <header>
    @include('header')
    </header>
    <br>
    <div class="container">
        @yield('content')
    </div>
</div>
    </div>
    <footer class="footer bg-dark  fixed-bottom">
    @include('footer')
    </footer>
</body>
</html>