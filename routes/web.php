<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();
// Verificar si el usuario está autenticado
// Usuario autenticado, redirigir a la vista de calendario
// Usuario no autenticado, mostrar la página de bienvenida

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('calendar.index');
    } else {
        return view('welcome');
    }
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/form', [App\Http\Controllers\FormController::class, 'index'])->name('form.index');

Route::post('/form', [App\Http\Controllers\FormController::class, 'store'])->name('form.store');

Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');

Route::get('/inflex', [App\Http\Controllers\InflexController::class, 'index'])->name('inflex');

Route::post('/event', [App\Http\Controllers\EventoController::class, 'index'])->name('events.index');

Route::post('/event', [App\Http\Controllers\EventoController::class, 'store'])->name('events.store');

Route::post('/destroy', [App\Http\Controllers\EventoController::class, 'destroy'])->name('events.destroy');

Route::post('/period', [App\Http\Controllers\PeriodoController::class, 'index'])->name('period.index');

use App\Http\Controllers\PeriodoController;

Route::middleware('web')->post('/period', [PeriodoController::class, 'store'])->name('period.store');

Route::get('/registroDiarioSintomas', [App\Http\Controllers\RegistroDiarioController::class, 'registroDiarioSintomas'])->name('registroDiarioSintomas');
Route::get('/registroDiarioEjercicio', [App\Http\Controllers\RegistroDiarioController::class, 'registroDiarioEjercicios'])->name('registroDiarioEjercicio');

Route::get('/estadisticas', [App\Http\Controllers\EstadisticasController::class, 'index'])->name('estadisticas');

Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');

Route::post('/uploadPerfil', [App\Http\Controllers\PerfilController::class, 'uploadPerfil'])->name('uploadPerfil');

Route::post('/uploadAvatar', [App\Http\Controllers\PerfilController::class, 'uploadAvatar'])->name('uploadAvatar');

use App\Http\Controllers\RegistroDiarioController;

Route::post('/guardar-sintomas', [RegistroDiarioController::class, 'storeSintomas'])->name('storeSintomas');
Route::post('/store-ejercicios', [RegistroDiarioController::class, 'storeEjercicios'])->name('storeEjercicios');

Route::get('/registro-diario-hecho', [RegistroDiarioController::class, 'registroDiarioHecho'])->name('RegistroDiarioHecho');


Route::put('/events/{id}', [App\Http\Controllers\EventoController::class, 'update'])->name('events.update');
Route::delete('/events/{id}', [App\Http\Controllers\EventoController::class, 'destroy'])->name('events.destroy');
