<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merry Meal | {{ $title_page }}</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{!! asset('/favicon.ico') !!}"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    @yield('component_content')
</body>
</html>
