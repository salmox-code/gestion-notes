<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🧑‍🎓 Saisie des notes – Étudiants
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4 bg-white p-4 rounded shadow-sm">
                <form method="GET" action="{{ route('etudiants.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="niveau" class="form-label">Niveau</label>
                        <select name="niveau" id="niveau" class="form-control">
                            <option value="">-- Tous les niveaux --</option>
                            <option value="CP1" {{ request('niveau') == 'CP1' ? 'selected' : '' }}>CP1</option>
                            <option value="CP2" {{ request('niveau') == 'CP2' ? 'selected' : '' }}>CP2</option>
                            <option value="DATA1" {{ request('niveau') == 'DATA1' ? 'selected' : '' }}>DATA</option>
                            <option value="TDIA1" {{ request('niveau') == 'TDIA1' ? 'selected' : '' }}>TDIA</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="search" class="form-label">Nom de l'étudiant</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">🔍 Filtrer</button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Classe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->classe->nom ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('notes.editNotes', ['etudiant_id' => $etudiant->id]) }}" class="btn btn-sm btn-primary">✏️ Notes</a>
                                    <a href="{{ route('etudiants.bulletin', $etudiant->id) }}" class="btn btn-sm btn-success">📘 Bulletin</a>
                                    <a href="{{ route('bulletin.envoyer', $etudiant->id) }}" class="btn btn-sm btn-outline-info">📤 Envoyer</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $etudiants->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
