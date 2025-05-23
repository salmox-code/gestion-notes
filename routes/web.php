<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\SurveillantController;
use App\Http\Controllers\ProfileController;
use App\Models\Convocation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ConvocationController; // ✅ Ajouté

// 🟢 Redirection page d'accueil
Route::get('/', function () {
    return redirect('/login');
});

// 🔐 Espace Admin sécurisé
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // 🏠 Dashboard principal
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // 👨‍🎓 Étudiants
    Route::resource('etudiants', EtudiantController::class)->names('admin.etudiants');

    // 👮‍♂️ Surveillants
    Route::resource('surveillants', SurveillantController::class)->names('admin.surveillants');

    // ✍️ Saisie des Notes
    Route::get('/notes', [AdminController::class, 'notes'])->name('admin.notes');
    Route::get('/notes/saisie', [NoteController::class, 'saisirNotes'])->name('notes.saisie');
    Route::post('/notes/store', [NoteController::class, 'storeNotes'])->name('notes.store');
    Route::delete('/notes/delete', [NoteController::class, 'destroy'])->name('notes.destroy');

    // 📄 Bulletins & PV
    Route::get('/notes/bulletin/{etudiant}', [NoteController::class, 'genererBulletin'])->name('notes.bulletin');
    Route::get('/notes/pv/{classe}/{matiere}', [NoteController::class, 'genererPV'])->name('notes.pv.classe');

//convocation 

Route::get('/test-pdf/{id}', function ($id) {
    $convocation = Convocation::with(['salle', 'surveillant'])->findOrFail($id);
    $pdf = Pdf::loadView('convocations.pdf', ['convocation' => $convocation]);
    return $pdf->stream(); // OU ->download('convocation.pdf');
});


Route::get('/convocations/list', [ConvocationController::class, 'index'])->name('convocations.index');
Route::delete('/convocations/{id}/delete', [ConvocationController::class, 'destroy'])->name('convocations.destroy');
Route::get('/convocations/{id}/pdf', [ConvocationController::class, 'downloadPdf'])->name('convocations.pdf');

    // 🧮 Saisie groupée filtrée
    Route::get('/saisie/niveau', [AdminController::class, 'choixNiveau'])->name('admin.saisie.niveau');
    Route::match(['GET', 'POST'], '/saisie/fetch', [AdminController::class, 'filtrerPourSaisie'])->name('admin.saisie.fetch');
    Route::post('/saisie/submit', [AdminController::class, 'submitNotes'])->name('admin.saisie.submit');

    // 🗂️ Saisie groupée directe
    Route::get('/saisie/group', [AdminController::class, 'saisieGroup'])->name('admin.saisie.group');

    // 📅 Redirection simple de /admin/convocations vers /admin/convocations/create
    Route::get('/convocations', fn() => redirect()->route('convocations.create'))->name('admin.convocations');

    // ✅ Création et enregistrement des convocations (ConvocationController)
    Route::get('/convocations/create', [ConvocationController::class, 'create'])->name('convocations.create');
    Route::post('/convocations/store', [ConvocationController::class, 'store'])->name('convocations.store');
});

// 👤 Profil utilisateur
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// 🔐 Modification directe du mot de passe depuis alerte
Route::middleware(['auth'])->group(function () {
    Route::get('/modifier-mot-de-passe', [ProfileController::class, 'edit'])->name('password.edit');
    Route::patch('/modifier-mot-de-passe', [ProfileController::class, 'update'])->name('password.update');
});


// 🎓 Bulletin public
Route::get('/etudiants/{id}/bulletin', [NoteController::class, 'bulletin'])->name('etudiants.bulletin');
Route::post('/etudiants/{id}/envoyer-bulletin', [NoteController::class, 'envoyerBulletin'])->name('bulletin.envoyer');

// 📝 Accès public aux notes
Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/edit', [NoteController::class, 'editNotes'])->name('notes.editNotes');
Route::post('/notes/update', [NoteController::class, 'updateNotes'])->name('notes.updateNotes');
Route::get('/notes/pv/pdf', [NoteController::class, 'exporterPV'])->name('notes.pv.pdf');

// 🔐 Auth Laravel Breeze
require __DIR__.'/auth.php';
