@extends('app')

@section('content')
    <div class="quiz-results-container">
        <div class="result-header">
            <a href="{{ route('home') }}" class="home-link"><i class="fa-solid fa-house"></i>Home</a>
            <a href="{{ route('profile') }}" class="profile-link"><i class="fa-solid fa-user"></i>{{ auth()->user()->username }}</a>
        </div>

        <div class="score-section">
            <h2>Your Score</h2>
            <p class="overall-score">{{ $results['overall'] }} / 20</p>
            <p class="xp-earned">XP Earned: {{ $xp }}</p>
        </div>

        <div class="category-scores">
            <h3>Category Breakdown</h3>
            <div class="categories">
                <div class="category">
                    <p><i class="fa-solid fa-palette"></i>Art</p>
                    <p>{{ $results['art'] }} / 4</p>
                </div>
                <div class="category">
                    <p><i class="fa-solid fa-book-atlas"></i>Geography</p>
                    <p>{{ $results['geography'] }} / 4</p>
                </div>
                <div class="category">
                    <p><i class="fa-solid fa-book"></i> History</p>
                    <p>{{ $results['history'] }} / 4</p>
                </div>
                <div class="category">
                    <p><i class="fa-solid fa-microscope"></i>Science</p>
                    <p>{{ $results['science'] }} / 4</p>
                </div>
                <div class="category">
                    <p><i class="fa-solid fa-futbol"></i>Sports</p>
                    <p>{{ $results['sports'] }} / 4</p>
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('quiz') }}" class="btn">Try Again<i class="fa-solid fa-rotate-right"></i></a>
        </div>
    </div>
@endsection
