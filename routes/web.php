<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\CommandeController;

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
    return view('home');
});

Route::view('/home','home')->middleware('auth');

Route::view('/admin','admin.admin_home')->middleware('auth')->middleware('is_admin');


Route::get('/login', [AuthenticatedSessionController::class,'showForm'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);

Route::get('/bienvenue', function () {
    return view('Bienvenue');
})->name('bienvenue');

Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->name('logout')->middleware('auth');

Route::get('/register', [RegisterUserController::class,'showForm'])
    ->name('register');
Route::post('/register', [RegisterUserController::class,'store']);




//ajouter une pizza :
Route::get('/pizzas/create', [App\Http\Controllers\PizzaController::class, 'create'])->middleware('auth')->name('pizzas.create');
Route::post('/pizzas', [App\Http\Controllers\PizzaController::class, 'store'])->middleware('auth')->name('pizzas.store');

// la liste des pizzas :
Route::get('/pizzas', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizzas.index');

// afficher le formulaire de modification :
// ->middleware('auth')->middleware('is_admin')
Route::get('/pizzas/{pizza}/edit', [App\Http\Controllers\PizzaController::class, 'edit'])->middleware('auth')->middleware('auth')->name('pizzas.edit');
// traiter la soumission du formulaire de modification :
Route::put('/pizzas/{pizza}', [App\Http\Controllers\PizzaController::class, 'update'])->middleware('auth')->name('pizzas.update');

// afficher le formulaire de changement de mot de passe :
Route::get('/changer-mot-de-passe', [App\Http\Controllers\ChangementMotDePasseController::class, 'edit'])->name('changer-mot-de-passe.edit');
// traiter le formulaire de changement de mot de passe :
Route::put('/changer-mot-de-passe', [App\Http\Controllers\ChangementMotDePasseController::class, 'update'])->name('changer-mot-de-passe.update');
//

Route::post('/cart/add/{pizza}', [App\Http\Controllers\PizzaController::class, 'addToCart'])->name('cart.add');
//
Route::get('/cart', [App\Http\Controllers\CommandeController::class, 'viewCart'])->name('cart.view');
// modifier la commande :
Route::POST('/cart/moddifer/{id}', [App\Http\Controllers\CommandeController::class, 'modifierCommande'])->name('cart.modifier');
// supprimer la commande :
Route::POST('/cart/supprimer/{id}', [App\Http\Controllers\CommandeController::class, 'supprimerCommande'])->name('cart.supprimer');
// passer la commande :
Route::post('/commande/valider', [App\Http\Controllers\CommandeController::class, 'passerCommande'])->name('cart.valider');

Route::get('/commandes-nontraite', [App\Http\Controllers\CommandeController::class,'show'])->name('commandes.show');
Route::get('/commandes-detail/{id}', [App\Http\Controllers\CommandeController::class,'showDetail'])->name('commandes.showdetail');
Route::get('/commandes-update/{id}', [App\Http\Controllers\CommandeController::class,'update'])->name('commandes.update');


