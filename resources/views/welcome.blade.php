<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" class="favicon" type="image/x-icon" href="/favicon.png"/>
    <title> @yield('title', setting('app_name', config('app.name')))</title>
</head>
<body>
<div id="app"></div>
    @vite('resources/js/main.js')
</body>
</html>
