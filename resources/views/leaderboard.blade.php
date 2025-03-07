@extends('app')

@section('content')
    <div class="leaderboard-container">
        <h1 class="leaderboard-title"><i class="fa-solid fa-award"></i>Leaderboard</h1>

        <table class="leaderboard-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>XP</th>
                    <th>Total Correct Answers</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topPlayers as $index => $player)
                    <tr>
                        <td>#{{ $index + 1 }}</td>
                        <td>{{ $player->username }}</td>
                        <td>{{ $player->xp }}</td>
                        <td>{{ $player->total_correct }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
