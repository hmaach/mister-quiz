<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mister Quiz</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav>
        <a class="btn" href="{{ route('leaderboard') }}">Leaderboard</a>

        <div style="display: flex;gap: 30px">
            @auth
                <a class="btn" href="{{ route('profile') }}">{{ auth()->user()->username }}</a>
            @endauth

            @guest
                <a class="btn" href="{{ route('login') }}">Login</a>

            @endguest


            @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn" href="">Logout</button>
                </form>
            @endauth
        </div>
    </nav>

    @yield('content')
</body>

</html>
