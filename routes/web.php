<?php

use App\Http\Livewire\CrudClient;
use App\Http\Livewire\CrudPost;
use App\Http\Livewire\CrudSensor;
use App\Http\Livewire\Index;
use App\Http\Livewire\News;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[Index::class,'render'])->name('index');
Route::get('/noticias',News::class)->name('noticias');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/posts',CrudPost::class)->name('noticias');
    Route::get('/clientes',CrudClient::class)->name('clientes');
    Route::get('/sensores',CrudSensor::class)->name('sensores');

    Route::get('/sensores/pdf', [CrudSensor::class, 'createPDF']); //reporte en pdf
});
