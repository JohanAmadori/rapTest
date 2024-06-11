<?php

use App\Http\Controllers\Auth\PasswordController;

use App\Models\Rappeur;



use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RappeurController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\BoutiqueController;

use App\Http\Controllers\FooterController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ArticleController;

use App\Http\Controllers\CartController;

use App\Http\Controllers\QuizzAttempsController;
use App\Http\Controllers\ReponseController;

use App\Http\Controllers\TopController;

use App\Http\Controllers\RatingController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [WelcomeController::class, 'accueil'])->name('home');
Route::get('/accueil', [WelcomeController::class, 'accueil'])->name('accueil');


Route::get('/legal', [LegalController::class, 'legal']);

Route::get('/footer', [FooterController::class, 'footer']);

Route::get('/top', [TopController::class, 'top']);


Route::get('/boutique',[BoutiqueController::class,'boutique']);
Route::get('/cartes',[BoutiqueController::class,'cartes']);

Route::get('/quiz_general',[QuizController::class,'quiz_general']);

Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');



Route::post('/quiz/questions', [QuizController::class, 'getQuestionsByDifficulty'])->name('quiz.getQuestionsByDifficulty');




Route::post('/boutique/acheter/{id}', [BoutiqueController::class, 'acheter'])->name('boutique.acheter');

Route::get('/cartes', [CartController::class, 'index'])->name('cartes');

Route::get('/classement', [UserController::class, 'index'])->name('classement');


Route::get('/cartes', [CartController::class, 'showCart'])->name('cartes');

Route::post('/quiz/enregistrerReponse', [QuizController::class, 'enregistrerReponse'])->name('quiz.enregistrerReponse');



Route::post('/rappeur/rate-rapper', [RatingController::class, 'rate'])->name('rate-rapper');

Route::get('/rappeur', [RappeurController::class, 'index'])->name('rappeurs');




Route::get('/quiz', [QuizController::class, 'showQuiz'])->name('quiz.show');

Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::post('/check-answer', [QuizController::class, 'checkAnswer']);



Route::post('/cart/add/{articleId}', 'CartController@addToCart')->name('cart.add');




Route::get('/rappeur', [QuizController::class, 'enregistrerReponse'])->name('rappeur');







Route::post('/quiz/{quizId}/submit-answer', [QuizController::class, 'submitAnswer'])->name('quiz.submit-answer');


// Assure-toi que la classe UserController est correctement importée
Route::get('/leaderboard', [UserController::class, 'showLeaderboard']);




Route::get('/boutique', [BoutiqueController::class, 'index']);













Route::post('/quizzes/{quizId}/start', 'QuizController@startQuiz')->middleware('auth');
Route::post('/quiz-attempts/{attemptId}/answer/{questionId}', 'QuizController@submitAnswer')->middleware('auth');



Route::post('/quiz/verify-answer', [QuizController::class, 'verifyAnswer'])->name('quiz.verifyAnswer');


Route::get('/quiz/reset-score', [QuizController::class, 'resetScore'])->name('quiz.resetScore');

Route::get('/user/score', [QuizController::class, 'getScore'])->name('user.score');

Route::get('/leaderboard', [QuizController::class, 'showLeaderboard'])->name('leaderboard');






Route::get('/rappeur', [RappeurController::class, 'index']);


Route::put('/user/password', [PasswordController::class, 'update'])->middleware('auth')->name('user-password.update');


Route::post('/boutique/articles', [BoutiqueController::class, 'createArticle'])->name('boutique.createArticle');
Route::put('/boutique/articles/{id}', [BoutiqueController::class, 'updateArticle'])->name('boutique.updateArticle');
Route::delete('/boutique/articles/{id}', [BoutiqueController::class, 'deleteArticle'])->name('boutique.deleteArticle');


Route::post('/update-points', [UserController::class, 'updatePoints']);


Route::post('/answer/{questionId}', [QuizController::class, 'answerQuestion']);



Route::get('/dashboard', function () {
    return view('accueil');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/boutique', function () {
    return view('boutique');
})->middleware(['auth', 'verified'])->name('boutique');




Route::get('/rappeur/{id}', [RappeurController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
