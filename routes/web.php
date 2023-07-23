<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\UserController;
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

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login.authenticate');

Route::get('/questionnaire/{questionnaire}/token/{token}', [
    QuestionnaireController::class,
    'startQuizByInvitationLink'
])->name('questionnaire.invitation');

Route::post('/questionnaire/{questionnaire}/invitation/submit', [
    QuestionnaireController::class,
    'submitQuizByInvitationLink'
])->name('questionnaire.invitation.submit');

Route::middleware(['auth'])
    ->group(function () {
        Route::get('logout', LogoutController::class)->name('logout');

        Route::get('/questionnaire/list', [
            QuestionnaireController::class,
            'listQuestionnaireForQuiz'
        ])->name('questionnaire.list');
        Route::get('/questionnaire/{questionnaire}/start', [
            QuestionnaireController::class,
            'startQuiz'
        ])->name('questionnaire.start');
        Route::post('/questionnaire/{questionnaire}/submit', [
            QuestionnaireController::class,
            'submitQuiz'
        ])->name('questionnaire.submit');

        Route::middleware(['can:admin'])
            ->group(function () {
                Route::resource('user', UserController::class)->except('show')->names('user');
                Route::resource('question', QuestionController::class)->except('show')->names('question');
                Route::resource('questionnaire', QuestionnaireController::class)->names('questionnaire');
            });
        
    });

