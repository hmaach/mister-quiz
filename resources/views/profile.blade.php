@extends('app')

@section('content')
    <div class="profile-container">
        <a href="{{ route('home') }}" class="back-link"><i class="fa-solid fa-house"></i>Home</a>

        <div class="profile-header">
            <h1 class="profile-name">{{ auth()->user()->username }}</h1>
            <p class="profile-email">{{ auth()->user()->email }}</p>
        </div>

        <div class="profile-xp-section">
            <p class="profile-xp">{{ auth()->user()->xp }} XP</p>
            <p class="profile-rank"><span>{{ $rank }}</span></p>
        </div>

        <div class="profile-stats">
            <h2>Quiz Performance</h2>
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Correct Answers</th>
                        <th>Total Questions</th>
                        <th>Accuracy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoryData as $category => $data)
                        <tr>
                            <td>{{ ucfirst($category) }}</td>
                            <td>{{ $data['correct'] }}</td>
                            <td>{{ $data['total'] }}</td>
                            <td>{{ $data['percentage'] }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
