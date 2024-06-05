<?php

use App\Http\Controllers\AssistController;
use App\Http\Controllers\LogginController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\Login;
use App\Models\Student;

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
Route::resource('products', ProductController::class);

Route::get('details', [ProductController::class, 'details']);
Route::post('insertProduct', [ProductController::class, 'insertProduct']);
Route::get('products/{id}', [ProductController::class, 'respuestaProd']);
Route::get('assists/{id}' , [StudentController::class, 'asistencia'])->name('students.assists');
Route::get('log')->middleware(Login::class);

Route::get('/logging', [LogginController::class, 'index'])->name('loggings')->middleware('admin');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    ///////muestra la vista para buscar el estudiante
    Route::get('/findStudent', [AssistController::class, 'mostrarVista'])->name('students.findStudent');
    //////ruta de tipo post para enviar la peticion y muestre otra pantalla/////
    Route::post('encontrado/student', [AssistController::class, 'buscarStudent'])->name('students.encontrado');
    //////ruta que envia la asistencia/////
    Route::post('assistInsert/{id}', [AssistController::class, 'createAssist'])->name('assist.insert');
    Route::resource('parameters', ParameterController::class);
    Route::get('/condition', [StudentController::class, 'condition'])->name('students.condition');
    Route::get('student/export', [StudentController::class, 'export'])->name('students.export');
});


require __DIR__.'/auth.php';

