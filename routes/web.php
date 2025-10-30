<?php
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DocumentController;
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

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

/* Route pour changer la langue */
Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');


/**/
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');

/**/
Route::get('/registration', [UserController::class, 'create'])->name('user.create');
Route::post('/registration', [UserController::class, 'store'])->name('user.store');


 Route::middleware('auth')->group(function () {
        Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');
        Route::get('/create/etudiant', [EtudiantController::class, 'create'])->name('etudiant.create');
        Route::post('/create/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');
        Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');
        Route::get('/edit/etudiant/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
        Route::put('/edit/etudiant/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
        Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.delete');

        Route::get('/create/article', [ArticleController::class, 'create'])->name('article.create');
        Route::post('/create/article', [ArticleController::class, 'store'])->name('article.store');
        Route::get('/edit/article/{article}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::put('/edit/article/{article}', [ArticleController::class, 'update'])->name('article.update');
        Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');

        Route::get('/documents', [DocumentController::class, 'index'])->name('document.index');
        Route::get('/documents/create', [DocumentController::class, 'create'])->name('document.create');
        Route::post('/documents', [DocumentController::class, 'store'])->name('document.store');
        Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('document.edit');
        Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('document.update');
        Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('document.destroy');
        Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('document.download');

 });