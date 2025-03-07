@extends('app')

@section('content')

<div class="register-container">
    <form action="{{ route('register') }}" method="POST" class="register-card" id="register-form" >
        @csrf
        <h1>Register</h1>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="username" required/>
        <span class="error" id="register-error">
            @error('username')
            {{ $message }}
            @enderror
        </span>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="email" required/>
        <span class="error" id="register-error">
            @error('email')
            {{ $message }}
            @enderror
        </span>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="password" required/>
        <span class="error" id="register-error">
            @error('password')
            {{ $message }}
            @enderror
        </span>
        <label for="password_confirmation">Password confirmation</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="password confirmation" required/>
        <span class="error" id="register-error">
            @error('password_confirmation')
            {{ $message }}
            @enderror
        </span>
        <button id="register-button" class="btn">Register <i class="fa-solid fa-right-to-bracket"></i></button>
        <a class="" href="{{ route('login') }}">Already have an account? Login</a>
    </form>
  </div>

@endsection