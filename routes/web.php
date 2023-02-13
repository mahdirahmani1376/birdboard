<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTasksController;
use Illuminate\Support\Facades\Route;

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

Route::group(['controller' => ProjectController::class,'prefix' => 'projects', 'middleware' => ['auth']], function () {
    Route::get('/', 'index')->name('projects.index');
    Route::get('/{project}', 'show')->name('projects.show')->middleware(['can:view,project']);
    Route::post('/', 'store')->name('projects.store');
    Route::get('/create/form', 'create')->name('projects.create');
    Route::put('/{project}/update', 'update')->name('projects.update');
});

Route::group(['controller' => ProjectTasksController::class,'middleware' => ['auth']],function(){
   Route::post('/projects/{project}/tasks','store')->name('tasks.store');
   Route::patch('/projects/{project}/tasks/{task}','update')->name('tasks.update');
});


require __DIR__.'/auth.php';
