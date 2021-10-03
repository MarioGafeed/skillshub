<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
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
     Route::get('/exams/show-question/{exam}', [AdminExamController::class, 'showQuestions']);
     Route::get('/exams/create', [AdminExamController::class, 'create']);
     Route::get('/exams/create-questions/{exam}', [AdminExamController::class, 'createQuestions']);
     Route::post('/exams/store-questions/{exam}', [AdminExamController::class, 'storeQuestions']);
     Route::post('/exams/store', [AdminExamController::class, 'store']);
     Route::get('/exams/edit/{exam}', [AdminExamController::class, 'edit']);
     Route::post('/exams/update/{exam}', [AdminExamController::class, 'update']);
     Route::get('/exams/edit-question/{exam}/{question}', [AdminExamController::class, 'editQuestion']);
     Route::post('/exams/update-question/{exam}/{question}', [AdminExamController::class, 'updateQuestion']);
     Route::get('/exams/toggle/{exam}', [AdminExamController::class, 'toggle']);
     Route::get('/exams/delete/{exam}', [AdminExamController::class, 'delete']);

  // For Students
     Route::get('/students', [StudentController::class, 'index']);
     Route::get('/students/show-scores/{id}', [StudentController::class, 'showScores']);
     Route::get('/students/open-exam/{studentId}/{examId}', [StudentController::class, 'openExam']);
     Route::get('/students/close-exam/{studentId}/{examId}', [StudentController::class, 'closeExam']);
     Route::get('/students/toggle/{user}', [StudentController::class, 'toggle']);

// for Admins
     Route::middleware('superadmin')->group(function(){
     Route::get('admins', [AdminController::class, 'index']);
     Route::get('admins/create', [AdminController::class, 'create']);
     Route::post('admins/store', [AdminController::class, 'store']);
     Route::get('admins/promote/{id}', [AdminController::class, 'promote']);
     Route::get('admins/demote/{id}', [AdminController::class, 'demote']);
      });
   });

   // Authentication...
       Route::get('/login', [AuthenticatedSessionController::class, 'create'])
           ->middleware(['guest:'.config('fortify.guard'),'lang'])
           ->name('login');
