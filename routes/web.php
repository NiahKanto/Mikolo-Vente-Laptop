<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\PointVenteController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ProcesseurController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\TransfertController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\RenvoiController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CommissionController;

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
    return view('login');
});

Route::get('/admin', function () {
    return view('loginAdmin');
});

Route::get('/login',[UtilisateurController::class,'login']); 
Route::get('/loginAdmin',[UtilisateurController::class,'loginAdmin']);
Route::get('/logout',[UtilisateurController::class,'logout']);
Route::get('/logoutAdmin',[UtilisateurController::class,'logoutAdmin']);

Route::get('/accueil',[UtilisateurController::class,'accueil'])->name('accueil'); 
Route::get('/accueilAdmin',[UtilisateurController::class,'accueilAdmin']);

Route::get('/pointvente',[UtilisateurController::class,'pointVenteAdmin'])->name('pointventeAdmin');
Route::get('/marque',[UtilisateurController::class,'marqueAdmin'])->name('marqueAdmin');
Route::get('/processeur',[UtilisateurController::class,'processeurAdmin'])->name('processeurAdmin'); 
Route::get('/reference',[UtilisateurController::class,'referenceAdmin'])->name('referenceAdmin'); 
Route::get('/utilisateur',[UtilisateurController::class,'utilisateurAdmin']); 
Route::get('/transfert',[UtilisateurController::class,'transfertAdmin'])->name('transfert');
Route::get('/laptop',[UtilisateurController::class,'laptop'])->name('laptop'); 
Route::get('/vente',[UtilisateurController::class,'venteAdmin']); 
Route::get('/benefice',[UtilisateurController::class,'beneficeAdmin']); 
Route::get('/listevente',[UtilisateurController::class,'listeVente']); 
Route::get('/renvoi',[UtilisateurController::class,'renvoiAdmin'])->name('renvoi');
Route::get('/commission',[UtilisateurController::class,'commissionAdmin']);
Route::get('/detail',[UtilisateurController::class,'detailvente']);

Route::get('/insertionLaptop',[LaptopController::class,'nouveau']);
Route::get('/insertionPointVente',[PointVenteController::class,'nouveau']);
Route::get('/modifierPointVente',[PointVenteController::class,'modifier']);
Route::get('/suppressionPointVente',[PointVenteController::class,'delete']);
Route::get('/insertionMarque',[MarqueController::class,'nouveau']);
Route::get('/modifierMarque',[MarqueController::class,'modifier']);
Route::get('/suppressionMarque',[MarqueController::class,'delete']);
Route::get('/insertionProcesseur',[ProcesseurController::class,'nouveau']);
Route::get('/suppressionProcesseur',[ProcesseurController::class,'delete']);
Route::get('/insertionReference',[ReferenceController::class,'nouveau']);
Route::get('/suppressionReference',[ReferenceController::class,'delete']);
Route::get('/insertionUtilisateur',[UtilisateurController::class,'nouveau']);
Route::get('/modifierUtilisateur',[UtilisateurController::class,'modifier']);
Route::get('/suppressionUtilisateur',[UtilisateurController::class,'delete']);
Route::get('/insertionTransfert',[TransfertController::class,'nouveau']);
Route::get('/insertionReception',[ReceptionController::class,'nouveau']);
Route::get('/insertionRenvoi',[RenvoiController::class,'nouveau']);
Route::get('/receptionRenvoi',[RenvoiController::class,'reception']);
Route::get('/insertionVente',[VenteController::class,'nouveau']);
Route::get('/insertionCommission',[CommissionController::class,'nouveau']);
Route::get('/suppressionCommission',[CommissionController::class,'delete']);
Route::get('/supprimerVente',[VenteController::class,'supprimer']);

Route::get('/pdfvente',[VenteController::class,'generatePDF']);
Route::get('/pdfventepv',[VenteController::class,'generatePDFpv']);

Route::get('/upload',[VenteController::class,'uploadImage']);
Route::get('/mail',[MailController::class,'envoi']);
Route::get('/test',[CommissionController::class,'test']);







Route::get('/loginservice/{pseudo}/{mdp}',[UtilisateurController::class,'loginService']); 