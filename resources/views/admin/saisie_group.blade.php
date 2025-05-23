<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Saisie de Notes & Bulletins — Niveau : {{ $niveau }}{{ $filiere ? ' - ' . $filiere : '' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Notification --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- 🔍 Filtre --}}
            <div class="bg-white p-4 rounded shadow-sm mb-4">
                <form method="GET" action="{{ route('admin.saisie.fetch') }}" class="row g-3 align-items-end">
                    <input type="hidden" name="niveau" value="{{ $niveau }}">
                    @if ($filiere)
                        <input type="hidden" name="filiere" value="{{ $filiere }}">
                    @endif

                    <div class="col-md-6">
                        <label for="search" class="form-label">Rechercher un étudiant</label>
                        <input type="text" name="search" id="search" class="form-control"
                            placeholder="Entrez un nom" value="{{ request('search') }}">
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">🔍 Rechercher</button>
                    </div>
                </form>
            </div>

            {{-- 📋 Liste des étudiants --}}
            <div class="bg-white p-6 rounded shadow-sm">
                @if ($etudiants->count())
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Classe</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->nom }}</td>
                                    <td>{{ $etudiant->prenom }}</td>
                                    <td>{{ $etudiant->classe->nom ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- Notes --}}
                                            <a href="{{ route('notes.editNotes', ['etudiant_id' => $etudiant->id]) }}"
                                               class="btn btn-sm btn-primary">✏️ Notes</a>

                                            {{-- Bulletin PDF --}}
                                            <a href="{{ route('etudiants.bulletin', $etudiant->id) }}"
                                               class="btn btn-sm btn-success">📘 Bulletin</a>

                                            {{-- Envoyer par email --}}
                                            <form method="POST" action="{{ route('bulletin.envoyer', $etudiant->id) }}">
                                                @csrf
                                                <input type="hidden" name="niveau" value="{{ $niveau }}">
                                                @if($filiere)
                                                    <input type="hidden" name="filiere" value="{{ $filiere }}">
                                                @endif
                                                <input type="hidden" name="search" value="{{ request('search') }}">
                                                <button type="submit" class="btn btn-sm btn-outline-info">📤 Envoyer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $etudiants->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <p class="text-center text-muted">⚠ Aucun étudiant trouvé pour ce niveau.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
