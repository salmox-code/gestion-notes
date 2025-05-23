<a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="{{ route('etudiants.bulletin', $etudiant->id) }}" class="btn btn-secondary btn-sm">📄 Bulletin</a>
                        <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>












                        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'notes' => 'required|array',
        ]);
        
    
        $etudiantId = $request->etudiant_id;
        $notes = $request->notes;
        dd($request->all());
    
        foreach ($notes as $matiereId => $valeur) {
            if ($valeur !== null && $valeur !== '') {
                Note::updateOrCreate(
                    ['etudiant_id' => $etudiantId, 'matiere_id' => $matiereId],
                    ['valeur' => $valeur]
                );
            }
        }
    
        return back()->with('success', 'Toutes les notes ont été enregistrées ou mises à jour.');


// dans notecontroller


        public function create(Request $request)
    {
        $etudiant = Etudiant::findOrFail($request->etudiant_id);
        $niveau = $etudiant->niveau ?? $etudiant->classe ?? 'N/A';

        $matieresDuNiveau = Matiere::where('niveau', $niveau)->get();

        $matieresNoteesIds = Note::where('etudiant_id', $etudiant->id)->pluck('matiere_id')->toArray();

        $matieresDisponibles = $matieresDuNiveau->filter(fn($matiere) => !in_array($matiere->id, $matieresNoteesIds));
        $matieresNotees = $matieresDuNiveau->filter(fn($matiere) => in_array($matiere->id, $matieresNoteesIds));

        $notesExistantes = Note::where('etudiant_id', $etudiant->id)->pluck('valeur', 'matiere_id');

        return view('notes.edit_notes', [
            'etudiant' => $etudiant,
            'niveau' => $niveau,
            'matieres' => $matieresDisponibles,
            'matieresModifiables' => $matieresNotees,
            'notesExistantes' => $notesExistantes,
        ]);
    }

    //fichier web
    //saisie de note
Route::get('/admin/notes/etudiant', [NoteController::class, 'create'])->name('notes.create');
Route::resource('notes', NoteController::class);

// fichier note.index
<a href="{{ route('notes.create') }}" class="btn btn-success mb-3">➕Ajouter une note</a>

// notecontroller 
public function envoyerBulletin($etudiant_id)
{
    dd('Méthode appelée');
    $etudiant = Etudiant::with('notes.matiere')->findOrFail($etudiant_id);
    $notes = $etudiant->notes;

    $moyenne = $notes->avg('valeur');
    $mention = $moyenne >= 10 ? '✅ Validé' : '❌ Ajourné';

    // Génère le PDF
    $pdf = Pdf::loadView('notes.bulletin', compact('etudiant', 'notes', 'moyenne', 'mention'));

    // Envoi de l’email
    Mail::to($etudiant->email)->send(new BulletinEtudiantMail($pdf, $etudiant));

    return back()->with('success', '📧 Bulletin envoyé avec succès à ' . $etudiant->prenom);
}
//app.blade
{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  
    @yield('title', 'Gestion des notes')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Espace Admin</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('etudiants.index') }}">Étudiants</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('matieres.index') }}">Matières</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('notes.index') }}">Notes</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
//dashboard.blade

@extends('layouts.app')

@section('title', 'Tableau de bord Admin')

@section('content')
<div class="container mt-5">

    <h2 class="mb-4 text-center text-primary fw-bold">🎓 Espace Administrateur</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.choose') }}" class="p-4 border rounded shadow-sm bg-light">
        @csrf
        <div class="form-group mb-3">
            <label for="action">Que souhaitez-vous faire ?</label>
            <select name="action" id="action" class="form-control" required>
                <option value="">-- Sélectionner une action --</option>
                <option value="notes_bulletins">📝 Saisie des notes & 📘 Bulletins</option>
                <option value="convocation">📅 Générer convocation de surveillance</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100">🚀 Continuer</button>
    </form>
</div>
@endsection

//menu.blade
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🎯 Tableau de bord administrateur
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">

            <!-- Carte Étudiants -->
            <a href="{{ route('admin.etudiants.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-lg shadow text-center transition">
                <div class="text-5xl mb-2">👨‍🎓</div>
                <div class="text-lg font-semibold">Gérer Étudiants</div>
            </a>

            <!-- Carte Surveillants -->
            <a href="{{ route('admin.surveillants.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white p-6 rounded-lg shadow text-center transition">
                <div class="text-5xl mb-2">👮‍♂️</div>
                <div class="text-lg font-semibold">Gérer Surveillants</div>
            </a>

            <!-- Carte Saisie Notes -->
            <a href="{{ route('admin.notes') }}" class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-lg shadow text-center transition">
                <div class="text-5xl mb-2">📝</div>
                <div class="text-lg font-semibold">Saisie Notes & Bulletins</div>
            </a>

            <!-- Carte Convocations -->
            <a href="{{ route('admin.convocations') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg shadow text-center transition">
                <div class="text-5xl mb-2">📅</div>
                <div class="text-lg font-semibold">Convocation Surveillance</div>
            </a>

        </div>
    </div>
</x-app-layout>
//logoiiiiiiinnn
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
//lang These credentials do not match our records.