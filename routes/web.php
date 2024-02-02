<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\admin\HomeController as AdminHomeController;
use  App\Http\Controllers\admin\CatController as AdminCatController;
use  App\Http\Controllers\admin\SkillController as AdminSkillController;
use  App\Http\Controllers\admin\ExamController as AdminExamController;
use  App\Http\Controllers\admin\StudentController;
use  App\Http\Controllers\admin\AdminController;
use  App\Http\Controllers\Web\HomeController;
use  App\Http\Controllers\Web\SkillController;
use  App\Http\Controllers\Web\CatController;
use  App\Http\Controllers\Web\ExamController;
use  App\Http\Controllers\Web\ContactController;
use  App\Http\Controllers\Web\ProfileController;
use  App\Http\Controllers\Web\LangController;

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

Route::middleware('lang')->group(function() {
  Route::get('/', [HomeController::class, 'index']);

  Route::get('/categories/show/{id}', [CatController::class, 'show']);
  Route::get('/skills/show/{id}', [SkillController::class, 'show']);
  Route::get('/exams/show/{id}', [ExamController::class, 'show']);
// Start Exam

  Route::get('/exams/show/questions/{id}', [ExamController::class, 'showquestions'])->middleware(['auth', 'student']);



// End Exam Route
  Route::get('/contact', [ContactController::class, 'index']);
  Route::post('/contact/message/send', [ContactController::class, 'send']);
  Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'student']);
  Route::get('/profile/show_answers/{exam}', [ProfileController::class, 'show_answers'])->middleware(['auth', 'student']);
});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth', 'student',  'can-enter-exam']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth', 'student']);

Route::get('/lang/set/{lang}', [LangController::class, 'set']);

// Route for Dashboard
// remove can 'verified',
Route::middleware(['auth', 'verified', 'can-enter-dashboard'] )->group(function()
 {
     Route::get('dashboard/', [AdminHomeController::class, 'index']);
     Route::get('dashboard/categories', [AdminCatController::class, 'index']);
     Route::post('dashboard/categories/store', [AdminCatController::class, 'store']);
     Route::post('dashboard/categories/update', [AdminCatController::class, 'update']);
     Route::get('dashboard/categories/toggle/{cat}', [AdminCatController::class, 'toggle']);
     Route::get('dashboard/categories/delete/{cat}', [AdminCatController::class, 'delete']);
// For Skills
     Route::get('dashboard/skills', [AdminSkillController::class, 'index']);
     Route::post('dashboard/skills/store', [AdminSkillController::class, 'store']);
     Route::post('dashboard/skills/update', [AdminSkillController::class, 'update']);
     Route::get('dashboard/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);
     Route::get('dashboard/skills/delete/{skill}', [AdminSkillController::class, 'delete']);

// For Exams
     Route::get('dashboard/exams', [AdminExamController::class, 'index']);
     Route::get('dashboard/exams/show/{exam}', [AdminExamController::class, 'show']);
     Route::get('dashboard/exams/show-question/{exam}', [AdminExamController::class, 'showQuestions']);
     Route::get('dashboard/exams/create', [AdminExamController::class, 'create']);
     Route::get('dashboard/exams/create-questions/{exam}', [AdminExamController::class, 'createQuestions']);
     Route::post('dashboard/exams/store-questions/{exam}', [AdminExamController::class, 'storeQuestions']);
     Route::post('dashboard/exams/store', [AdminExamController::class, 'store']);
     Route::get('dashboard/exams/edit/{exam}', [AdminExamController::class, 'edit']);
     Route::post('dashboard/exams/update/{exam}', [AdminExamController::class, 'update']);
     Route::get('dashboard/exams/edit-question/{exam}/{question}', [AdminExamController::class, 'editQuestion']);
     Route::post('dashboard/exams/update-question/{exam}/{question}', [AdminExamController::class, 'updateQuestion']);
     Route::get('dashboard/exams/toggle/{exam}', [AdminExamController::class, 'toggle']);
     Route::get('dashboard/exams/delete/{exam}', [AdminExamController::class, 'delete']);

  // For Students
     Route::get('dashboard/students', [StudentController::class, 'index']);
     Route::get('dashboard/students/create', [StudentController::class, 'create']);
     Route::post('dashboard/students/store', [StudentController::class, 'store']);
     Route::get('dashboard/students/show-scores/{id}', [StudentController::class, 'showScores']);
     Route::get('dashboard/students/open-exam/{studentId}/{examId}', [StudentController::class, 'openExam']);
     Route::get('dashboard/students/close-exam/{studentId}/{examId}', [StudentController::class, 'closeExam']);
     Route::get('dashboard/students/toggle/{user}', [StudentController::class, 'toggle']);
     Route::get('dashboard/students/show_answers/{studentId}/{examId}', [StudentController::class, 'show_answers']);

// for Admins
     Route::middleware('superadmin')->group(function(){
     Route::get('dashboard/admins', [AdminController::class, 'index']);
     Route::get('dashboard/admins/create', [AdminController::class, 'create']);
     Route::post('dashboard/admins/store', [AdminController::class, 'store']);
     Route::get('dashboard/admins/promote/{id}', [AdminController::class, 'promote']);
     Route::get('dashboard/admins/demote/{id}', [AdminController::class, 'demote']);
      });
   });
