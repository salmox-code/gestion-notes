<x-app-layout>
    <x-slot name="header">
        
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    ✏️ Modifier l'étudiant : {{ $etudiant->nom }} ({{ $etudiant->classe->nom ?? 'N/A' }})
</h2>
        </
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow p-6 rounded">

                <form action="{{ route('admin.etudiants.update', $etudiant) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label">Nom :</label>
                        <input type="text" name="nom" value="{{ $etudiant->nom }}" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Prénom :</label>
                        <input type="text" name="prenom" value="{{ $etudiant->prenom }}" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email :</label>
                        <input type="email" name="email" value="{{ $etudiant->email }}" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">CNE :</label>
                        <input type="text" name="cne" value="{{ $etudiant->cne }}" class="form-control" required>
                    </div>

                    <div class="mb-4">
    <label class="form-label">Niveau :</label>
    <select name="niveau" class="form-select" required>
        <option value="">-- Choisir un niveau --</option>
        <option value="CP1" {{ $etudiant->niveau == 'CP1' ? 'selected' : '' }}>CP1</option>
        <option value="CP2" {{ $etudiant->niveau == 'CP2' ? 'selected' : '' }}>CP2</option>
        <option value="DATA1" {{ $etudiant->niveau == 'DATA1' ? 'selected' : '' }}>DATA1</option>
        <option value="TDIA1" {{ $etudiant->niveau == 'TDIA1' ? 'selected' : '' }}>TDIA1</option>
    </select>
</div>


                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">✅ Mettre à jour</button>
                        <a href="{{ route('admin.etudiants.index') }}" class="btn btn-secondary">❌ Annuler</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

