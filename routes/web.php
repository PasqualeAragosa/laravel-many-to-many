<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;

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

Route::middleware('auth', 'verified')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project:slug'
    ]);

    Route::resource('types', typeController::class)->parameters([
        'types' => 'type:slug'
    ])->except(['show', 'create', 'edit',]); //creo le view eccetto show, create e edit, poichè non mi servono

    Route::resource('technologies', technologyController::class)->parameters([
        'technologies' => 'technology:slug'
    ])->except(['show', 'create', 'edit',]); //creo le view eccetto show, create e edit, poichè non mi servono
});

require __DIR__ . '/auth.php';
