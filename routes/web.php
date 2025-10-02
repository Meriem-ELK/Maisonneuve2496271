<?php
use App\Http\Controllers\EtudiantController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('etudiant.index');
});


    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');
    Route::get('/create/etudiant', [EtudiantController::class, 'create'])->name('etudiant.create');
    Route::post('/create/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');
    Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');
    Route::get('/edit/etudiant/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
    Route::put('/edit/etudiant/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
    Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.delete');
