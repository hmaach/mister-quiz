<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Rank calculation based on XP
        $xp = $user->xp;
        $rank = match (true) {
            $xp < 1500 => 'Quiz Apprentice',
            $xp >= 1500 && $xp < 5000 => 'Average Quizer',
            $xp >= 5000 && $xp < 10000 => 'Epic Quizer',
            default => 'Quiz Master'
        };

        // Score tracking per category
        $categories = ['art', 'geography', 'history', 'science', 'sports'];
        $categoryData = [];

        foreach ($categories as $category) {
            [$correct, $total] = explode("/", $user->$category);
            $percentage = $total > 0 ? round(($correct / $total) * 100, 2) : 0;
            $categoryData[$category] = [
                'correct' => $correct,
                'total' => $total,
                'percentage' => $percentage
            ];
        }

        return view('profile', compact('user', 'rank', 'categoryData'));
    }
}
