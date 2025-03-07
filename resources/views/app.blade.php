<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Mister Quiz</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav>
        <a class="btn" href="{{ route('leaderboard') }}"><i class="fa-solid fa-medal"></i>Leaderboard</a>

        <div style="display: flex;gap: 30px">
            @auth
                <a class="btn" href="{{ route('profile') }}"><i class="fa-solid fa-user"></i>{{ auth()->user()->username }}</a>
            @endauth

            @guest
                <a class="btn" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i>Login</a>

            @endguest


            @auth
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn" href=""><i
                            class="fa-solid fa-right-from-bracket"></i>Logout</button>
                </form>
            @endauth
        </div>
    </nav>

    @yield('content')
</body>

</html>
