<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👨‍🎓 Liste des étudiants
        </h2>
    </x-slot>

    {{-- ✅ Message de succès --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show my-4 mx-auto w-75" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Barre de filtrage + bouton ajouter --}}
            <div class="bg-white p-4 rounded shadow-sm mb-4">
                <form method="GET" action="{{ route('admin.etudiants.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="niveau" class="form-label">Niveau</label>
                        <select name="niveau" class="form-select">
                            <option value="">Tous les niveaux</option>
                            <option value="CP1" {{ request('niveau') == 'CP1' ? 'selected' : '' }}>CP1</option>
                            <option value="CP2" {{ request('niveau') == 'CP2' ? 'selected' : '' }}>CP2</option>
                            <option value="DATA1" {{ request('niveau') == 'DATA1' ? 'selected' : '' }}>DATA1</option>
                            <option value="TDIA1" {{ request('niveau') == 'TDIA1' ? 'selected' : '' }}>TDIA1</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="search" class="form-label">Rechercher par nom</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Ex: El Idrissi">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">🔍 Filtrer</button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('admin.etudiants.index') }}" class="btn btn-outline-secondary w-100">♻️ Réinitialiser</a>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('admin.etudiants.create') }}" class="btn btn-success w-100">
                            ➕ Ajouter un étudiant
                        </a>
                    </div>
                </form>
            </div>

            {{-- ✅ Tableau des étudiants --}}
            <div class="bg-white p-4 rounded shadow">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>CNE</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->id }}</td>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>{{ $etudiant->cne }}</td>
                                <td class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('admin.etudiants.edit', $etudiant->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                                    <form action="{{ route('admin.etudiants.destroy', $etudiant->id) }}" method="POST" onsubmit="return confirm('Supprimer cet étudiant ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucun étudiant trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- ✅ Pagination --}}
                <div class="mt-3">
                    {{ $etudiants->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div> 
    </div>
</x-app-layout>
