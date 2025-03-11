@extends('app')

@section('content')

    <div class="quiz-container">
        <h1 class="quiz-title">Take the Quiz</h1>
        @if (session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('quiz.submit') }}" method="post" class="quiz-form">
            @csrf

            @if (!empty($quiz['questions']))
                @foreach ($quiz['questions'] as $question)
                    <x-question :question="$question" />
                @endforeach
            @else
                <p class="no-questions">No questions available.</p>
            @endif

            <button type="submit" class="btn">Submit</button>
        </form>
    </div>

@endsection
