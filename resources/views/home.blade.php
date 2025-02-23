@extends('app')

@section('content')

<div class="main-img">
    <h1 class="title">Mister</h1>
    <img src="{{ asset('images/logo.png') }}" alt="">

    <a style="margin-bottom:20px" class="btn" href="{{ route('quiz') }}">Start Quiz</a>
</div>

@endsection