<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

use App\Models\UserReponse;

use Illuminate\Database\QueryException;



class QuizController extends Controller
{
    public function showQuiz($quizId)
    {                
        $user = auth()->user();
    }  

    public function quiz_general()
{
    $quizs = Quiz::whereNull('rappeur_id')->get(); // Fetch quizzes without a rapper ID
    return view('quiz_general', compact('quizs'));
}

   

public function verifyAnswer(Request $request)
{
    $questionId = $request->input('question_id');
    $selectedAnswer = $request->input('answer_index');
    $question = Quiz::find($questionId);

    $user = auth()->user(); // Obtient l'utilisateur authentifié

    if (!$question) {
        return response()->json(['error' => 'Question non trouvée.']);
    }       

    $user = auth()->user();
    if (!$user) {
        return response()->json(['error' => 'Utilisateur non connecté.']);
    }

    $isCorrect = $selectedAnswer == $question->reponse;
    
    
    // Mettre à jour le score
    $score = session('score', 0);
    if ($isCorrect) {
        $score++;
        session(['score' => $score]);
        $user->increment('points');
    }

    session()->push('answered_questions', $questionId);

    return response()->json(['correct' => $isCorrect, 'score' => $score]);
}


    public function checkAnswer(Request $request)
    {
        $question = Quiz::find($request->questionId);
        $isCorrect = $question && $question->correct_answer === $request->answer;

        return response()->json([
            'correct' => $isCorrect,
            'message' => $isCorrect ? 'Correct!' : 'Incorrect, try again.'
        ]);
    }    

public function resetScore()
{
    session(['score' => 0, 'answered_questions' => [], 'quiz_completed' => false]);
    return redirect()->route('accueil'); 
}

public function showLeaderboard()
{
    $users = User::orderBy('points', 'desc')->get();
    return view('leaderboard', compact('users'));
}




    




}

