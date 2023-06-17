<?php

use App\Http\Controllers\ForumController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('learning', LearningController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::resource('forum', ForumController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::resource('quiz', QuizController::class)
    ->only(['index', 'store', 'create', 'show'])
    ->middleware(['auth', 'verified']);


// Route::get('quiz/create', [QuizController::class, 'create'])
//     ->name('quiz.create')
//     ->middleware(['auth', 'verified']);


Route::get('/quiz/{quiz}/question/create', [QuestionController::class, 'create'])
    ->name('quiz.question.create')
    ->middleware(['auth', 'verified']);

Route::post('/quiz/{quiz}/question', [QuestionController::class, 'store'])
    ->name('quiz.question.store')
    ->middleware(['auth', 'verified']); 

Route::get('/quiz/{quiz}/question', [QuestionController::class, 'show'])
    ->name('quiz.question.show')
    ->middleware(['auth', 'verified']);

// Route::post('/quiz/{quiz}/question/submit', [QuestionController::class, 'submitQuestion'])
//     ->name('quiz.question.submit')
//     ->middleware(['auth', 'verified']);

Route::get('/quiz/{quiz}/answer', [QuizController::class, 'answer'])
    ->name('quiz.answer')
    ->middleware(['auth', 'verified']);

Route::get('/quiz/{quiz}/result', [QuizController::class, 'result'])
    ->name('quiz.result')
    ->middleware(['auth', 'verified']);

Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])
    ->name('quiz.submit')
    ->middleware(['auth', 'verified']);

Route::get('/quiz/{quiz}/result/{score}', [QuizController::class, 'result'])
    ->name('quiz.result')
    ->middleware(['auth', 'verified']);




require __DIR__ . '/auth.php';
