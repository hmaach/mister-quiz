@extends('app')

@section('content')
    <div class="login-container">
        <form action="{{ route('login') }}" method="POST" class="login-card" id="login-form">
            @csrf
            <h1>Login</h1>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="email" required />
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="password" required />
            <span class="error" id="login-error">
                @error('email')
                    {{ $message }}
                @enderror
                @error('password')
                    {{ $message }}
                @enderror
            </span>

            <button id="login-button" class="btn">Login <i class="fa-solid fa-right-to-bracket"></i></button>
            <a class="" href="{{ route('register') }}">Don't have an account? Register</a>
        </form>
    </div>
@endsection
