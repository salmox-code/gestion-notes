<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            👨‍🎓 Gestion des Étudiants
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- ✅ Message de succès --}}
        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

      <form method="GET" action="{{ route('admin.etudiants') }}" class="row mb-4 g-3 align-items-end">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="🔍 Rechercher par nom" value="{{ request('search') }}">
    </div>

    <div class="col-md-4">
        <select name="niveau" class="form-select">
            <option value="">Tous les niveaux</option>
            <option value="CP1" {{ request('niveau') == 'CP1' ? 'selected' : '' }}>CP1</option>
            <option value="CP2" {{ request('niveau') == 'CP2' ? 'selected' : '' }}>CP2</option>
            <option value="DATA1" {{ request('niveau') == 'DATA1' ? 'selected' : '' }}>DATA1</option>
            <option value="TDIA1" {{ request('niveau') == 'TDIA1' ? 'selected' : '' }}>TDIA1</option>
        </select>
    </div>

    <div class="col-md-4">
        <button type="submit" class="btn btn-primary w-100">🔍 Filtrer</button>
      

    </div>
   
    
        
</form>
{{-- 🎯 Bouton Réinitialiser (petit, à droite) --}}
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.etudiants') }}" class="btn btn-outline-secondary btn-sm">
        ♻️ Réinitialiser
    </a>
</div>


<div class="mb-3 text-end">
    <a href="{{ route('etudiants.create') }}" class="btn btn-success">
        ➕ Ajouter un étudiant
    </a>
</div>


        {{-- ✅ Tableau stylisé --}}
        <div class="bg-white shadow-md rounded-lg overflow-auto p-4">
            <table class="table table-bordered table-striped w-full">
                <thead class="table-dark text-white bg-gray-800">
                    <tr>
                        <th class="text-left">Nom</th>
                        <th class="text-left">Prénom</th>
                        <th class="text-left">Email</th>
                        <th class="text-left">CNE</th>
                        <th class="text-left">Classe</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etudiant)
                        <tr class="hover:bg-gray-100 transition">
                            <td>{{ $etudiant->nom }}</td>
                            <td>{{ $etudiant->prenom }}</td>
                            <td>{{ $etudiant->email }}</td>
                            <td>{{ $etudiant->cne }}</td>
                            <td>{{ $etudiant->classe->nom ?? '—' }}</td>
                            <td class="text-center space-x-2">
                                  
                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning btn-sm">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet étudiant ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Suprimer🗑️</button>
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
        </div>

        {{-- ✅ Pagination horizontale centrée --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $etudiants->links('pagination::bootstrap-4') }}
        </div>

    </div>
</x-app-layout>
