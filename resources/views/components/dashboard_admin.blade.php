<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin page</title>
</head>
<body>
    <h1>welcome {{ auth()->user()->username }}</h1>
    <h3>loggin as {{ auth()->user()->role }}</h3>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <a href="#"><button type="submit" class="bg-[#FFCE01] h-[47px] w-[136.89px] hover:bg-[#282222] hover:text-[#FFCE01] duration-700">LOGOUT</button></a>
      </form>
</body>
</html>