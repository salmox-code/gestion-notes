<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👥 Gestion Étudiants & Surveillants
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto space-y-10">
        {{-- 🔹 PARTIE 1 : ÉTUDIANTS --}}
        <div class="bg-white shadow rounded p-6">
            <h3 class="text-lg font-bold mb-4">👨‍🎓 Liste des Étudiants</h3>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>CNE</th>
                        <th>Classe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etudiants as $etudiant)
                        <tr>
                            <td>{{ $etudiant->nom }}</td>
                            <td>{{ $etudiant->prenom }}</td>
                            <td>{{ $etudiant->email }}</td>
                            <td>{{ $etudiant->cne }}</td>
                            <td>{{ $etudiant->classe->nom ?? '—' }}</td>
                            <td class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">🗑️</button>
                                </form>
                                <a href="{{ route('notes.editNotes', ['etudiant_id' => $etudiant->id]) }}" class="btn btn-success btn-sm">✏️ Saisir Note</a>
                                <a href="{{ route('etudiants.bulletin', $etudiant->id) }}" class="btn btn-secondary btn-sm">📘 Bulletin</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-2">
                {{ $etudiants->links() }}
            </div>
        </div>

        {{-- 🔹 PARTIE 2 : SURVEILLANTS --}}
        <div class="bg-white shadow rounded p-6">
            <div class="d-flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">👮‍♂️ Liste des Surveillants</h3>
                <a href="{{ route('surveillants.create') }}" class="btn btn-primary btn-sm">➕ Ajouter Surveillant</a>
            </div>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveillants as $surveillant)
                        <tr>
                            <td>{{ $surveillant->nom }}</td>
                            <td>{{ $surveillant->prenom }}</td>
                            <td>{{ $surveillant->email }}</td>
                            <td class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('surveillants.edit', $surveillant->id) }}" class="btn btn-warning btn-sm">✏️</a>
                                <form action="{{ route('surveillants.destroy', $surveillant->id) }}" method="POST" onsubmit="return confirm('Supprimer ce surveillant ?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-2">
                {{ $surveillants->links() }}
            </div>
        </div>

        {{-- 🔹 PARTIE 3 : Saisie groupée & Bulletins --}}
        <div class="bg-white shadow rounded p-6">
            <h3 class="text-lg font-bold mb-4">📝 Saisie Groupée des Notes & Bulletins</h3>
            <p class="mb-3 text-muted">Cliquez ci-dessous pour accéder à la saisie des notes groupée et à la génération des bulletins par niveau.</p>

            <a href="{{ route('admin.saisie.niveau') }}" class="btn btn-outline-success w-full text-center p-3">
                ➕ Accéder à la saisie des notes groupée
            </a>
        </div>
    </div>
</x-app-layout>
