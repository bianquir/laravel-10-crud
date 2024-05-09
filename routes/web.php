<?php

use App\Http\Controllers\AssistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\Login;
use App\Models\Assist;
use App\Models\Product;
use App\Models\Student;
use Database\Factories\ProductFactory;

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
});

require __DIR__.'/auth.php';

///////muestra la vista para buscar el estudiante
Route::get('/findStudent', [AssistController::class, 'mostrarVista'])->name('students.findStudent');
//////ruta de tipo post para enviar la peticion y muestre otra pantalla/////
Route::post('encontrado/student', [AssistController::class, 'buscarStudent'])->name('students.encontrado');
//////ruta que envia la asistencia/////
Route::post('assistInsert/{id}', [AssistController::class, 'createAssist'])->name('assist.insert');