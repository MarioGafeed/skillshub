<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\web\HomeController;
use  App\Http\Controllers\web\SkillController;
use  App\Http\Controllers\web\CatController;
use  App\Http\Controllers\web\ExamController;
use  App\Http\Controllers\web\ContactController;
use  App\Http\Controllers\web\ProfileController;
use  App\Http\Controllers\web\LangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('lang')->group(function() {
  Route::get('/', [HomeController::class, 'index']);

  Route::get('/categories/show/{id}', [CatController::class, 'show']);
  Route::get('/skills/show/{id}', [SkillController::class, 'show']);
  Route::get('/exams/show/{id}', [ExamController::class, 'show']);
// Start Exam

  Route::get('/exams/show/questions/{id}', [ExamController::class, 'showquestions'])->middleware(['auth', 'student', 'verified']);



// End Exam Route
  Route::get('/contact', [ContactController::class, 'index'])->middleware(['verified']);
  Route::post('/contact/message/send', [ContactController::class, 'send']);
  Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'student', 'verified']);
});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth', 'student', 'verified', 'can-enter-exam']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth', 'student', 'verified']);

Route::get('/lang/set/{lang}', [LangController::class, 'set']);
