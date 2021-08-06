<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\admin\HomeController as AdminHomeController;
use  App\Http\Controllers\admin\CatController as AdminCatController;
use  App\Http\Controllers\admin\SkillController as AdminSkillController;
use  App\Http\Controllers\admin\ExamController as AdminExamController;
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

// Route for Dashboard
Route::prefix('dashboard')->middleware(['auth', 'verified', 'can-enter-dashboard'] )->group(function() {

     Route::get('/', [AdminHomeController::class, 'index']);
     Route::get('/categories', [AdminCatController::class, 'index']);
     Route::post('/categories/store', [AdminCatController::class, 'store']);
     Route::post('/categories/update', [AdminCatController::class, 'update']);
     Route::get('/categories/toggle/{cat}', [AdminCatController::class, 'toggle']);
     Route::get('/categories/delete/{cat}', [AdminCatController::class, 'delete']);
// For Skills
     Route::get('/skills', [AdminSkillController::class, 'index']);
     Route::post('/skills/store', [AdminSkillController::class, 'store']);
     Route::post('/skills/update', [AdminSkillController::class, 'update']);
     Route::get('/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);
     Route::get('/skills/delete/{skill}', [AdminSkillController::class, 'delete']);

// For Exams
     Route::get('/exams', [AdminExamController::class, 'index']);
     Route::get('/exams/show/{exam}', [AdminExamController::class, 'show']);
     Route::get('/exams/show/{id}/questions', [AdminExamController::class, 'showQuestions']);
     Route::get('/exams/create', [AdminExamController::class, 'create']);
     Route::post('/exams/store', [AdminExamController::class, 'store']);
     Route::get('/exams/edit/{id}', [AdminExamController::class, 'edit']);
     Route::post('/exams/update', [AdminExamController::class, 'update']);
     Route::get('/exams/toggle/{skill}', [AdminExamController::class, 'toggle']);
     Route::get('/exams/delete/{skill}', [AdminExamController::class, 'delete']);
   });
