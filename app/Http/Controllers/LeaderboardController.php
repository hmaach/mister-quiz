<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Fetch top 10 users ordered by XP
        $topPlayers = User::orderByDesc('xp')->limit(10)->get();

        // Calculate total correct answers for each user
        foreach ($topPlayers as $player) {
            $player->total_correct = collect(['art', 'geography', 'history', 'science', 'sports'])
                ->sum(fn($category) => explode("/", $player->$category)[0]);
        }

        return view('leaderboard', compact('topPlayers'));
    }
}
