<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is authenticated
        if ($request->user()) {
            if (!session()->has('quiz_questions')) {
                $categories = ['History', 'Art', 'Geography', 'Science', 'Sports'];
                $questions = [];

                // Getting 4 random questions from each category with their options
                foreach ($categories as $cat) {
                    $query_questions = Question::where('category', $cat)
                        ->inRandomOrder()
                        ->limit(4)
                        ->with('answers')
                        ->get();

                    foreach ($query_questions as $qq) {
                        $questions[] = [
                            'id' => $qq->id,
                            'question' => $qq->question,
                            'xp' => $qq->xp,
                            'category' => $qq->category,
                            'answers' => $qq->answers->map(function ($answer) {
                                return [
                                    'id' => $answer->id,
                                    'answer' => $answer->answer,
                                ];
                            })->toArray(),
                        ];
                    }
                }

                shuffle($questions);

                // Store the questions in the session
                session(['quiz_questions' => $questions]);
            } else {
                // Use the questions already in the session
                $questions = session('quiz_questions');
            }

            $quiz = ['questions' => $questions];

            return view('questions.list', compact('quiz'));
        }

        return redirect()->route('login')->with('error', 'You need to log in first.');
    }



    public function results(Request $request)
    {
        // Retrieve quiz questions from session
        $quizQuestions = session('quiz_questions', []);

        if (empty($quizQuestions)) {
            return redirect()->route('quiz')->with('error', 'No active quiz found.');
        }

        // Store quiz as completed
        session()->forget('quiz_questions');

        // Initialize results tracking
        $results = [
            'overall' => 0,
            'art' => 0,
            'geography' => 0,
            'history' => 0,
            'science' => 0,
            'sports' => 0
        ];
        $xp = 0;

        // Get user instance
        $user = Auth::user();

        // Process submitted answers
        foreach ($quizQuestions as $question) {
            $questionId = $question['id'];
            $category = strtolower($question['category']); // Ensure lowercase to match array keys

            // Check if user submitted an answer for this question
            if ($request->has("answer_$questionId")) {
                $selectedAnswerId = $request->input("answer_$questionId");

                // Find the correct answer for this question
                $correctAnswer = Answer::where('question_id', $questionId)
                    ->where('correct', 1)
                    ->first();

                if ($correctAnswer && $correctAnswer->id == $selectedAnswerId) {
                    // Correct answer
                    $results['overall']++;
                    $results[$category]++;
                    $xp += $question['xp']; // Add XP if correct
                }
            }
        }

        // Update user XP
        $user->xp += $xp;

        // Update category scores
        foreach ($results as $category => $correctAnswers) {
            if ($category !== 'overall') {
                // Retrieve current category score (e.g., "2/10")
                [$correct, $total] = explode("/", $user[$category] ?? "0/0");

                // Update with new values
                $user[$category] = ($correct + $correctAnswers) . "/" . ($total + 4);
            }
        }
        // Save user updates
        $user->save();

        // Return results to the view
        return view('questions.results', ['results' => $results, 'xp' => $xp]);
    }
}
