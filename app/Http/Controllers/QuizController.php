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
        $quiz = Quiz::with('options')->find($quizId);
    
        // Récupère les réponses de l'utilisateur pour ce quiz depuis la session
        $reponses = session('reponses', []);
    
        return view('quiz.show', compact('quiz', 'reponses'));
    }
    

    public function quiz_general()
{
    $quizs = Quiz::whereNull('rappeur_id')->get(); 
    return view('quiz_general', compact('quizs'));
}

public function finishQuiz(Request $request)
{
    $questions = Quiz::with('options')->get();
    $user = auth()->user();
    $answeredQuestionsCount = UserReponse::where('user_id', $user->id)->count();
    
    return view('rappeur', compact('questions', 'answeredQuestionsCount'));
}
   

public function verifyAnswer(Request $request)
    {       

        if (auth()->guest()) {
            return redirect()->route('rappeur')->with('login_error', 'Veuillez vous connecter pour continuer.');
        }

        $questionId = $request->input('question_id');
        $selectedAnswer = $request->input('answer_index');
        $question = Quiz::find($questionId);

        $user = auth()->user();

        if (!$question) {
            return response()->json(['error' => 'Question non trouvée.']);
        }

        if (!$user) {
            return response()->json(['error' => 'Utilisateur non connecté.']);
        }

        // L'utilisateur a déjà répondu à cette question
        $exists = UserReponse::where('user_id', $user->id)
            ->where('question_id', $questionId)
            ->exists();

        if ($exists) {
            return redirect()->route('rappeur');
        }

        // Enregistrer la réponse dans user_reponses
        UserReponse::create([
            'user_id' => $user->id,
            'question_id' => $questionId,
            'answer' => $selectedAnswer, 
        ]);

        // Vérifier si la réponse est correcte
        $isCorrect = $selectedAnswer == $question->reponse;

        // Mettre à jour le score si la réponse est correcte
        $score = session('score', 0);
        if ($isCorrect) {
            $score += 2;
            session(['score' => $score]);
            $user->increment('points', 2);
        }

        // Retourner la réponse JSON
        return response()->json(['correct' => $isCorrect, 'score' => $score]);

                // L'utilisateur a déjà répondu à cette question
                $exists = UserReponse::where('user_id', $user->id)
                ->where('question_id', $questionId)
                ->exists();
    
            if ($exists) {
                return redirect()->route('rappeur');
            }
    
            // Enregistrer la réponse dans user_reponses
            UserReponse::create([
                'user_id' => $user->id,
                'question_id' => $questionId,
                'answer' => $selectedAnswer, 
            ]);
    
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


public function getQuestionsByDifficulty(Request $request)
{
    $difficulty = $request->input('difficulty');

    // Fetch questions based on difficulty
    $questions = Quiz::where('difficulte', $difficulty)->get();

    return view('partials.questions', compact('questions'))->render();
}








}

