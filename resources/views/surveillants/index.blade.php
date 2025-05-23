<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👮‍♂️ Liste des Surveillants
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">

        {{-- ✅ Message de succès --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @php(session()->forget('success'))
            </div>
        @endif

        {{-- ✅ Carte blanche --}}
        <div class="bg-white p-4 rounded shadow-sm">

            {{-- ✅ Bouton aligné à gauche --}}
            <div class="mb-3">
                <a href="{{ route('admin.surveillants.create') }}" class="btn btn-primary">
                    ➕ Ajouter un surveillant
                </a>
            </div>

            {{-- ✅ Table style Bootstrap + Tailwind --}}
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($surveillants as $surveillant)
                        <tr>
                            <td>{{ $surveillant->id }}</td>
                            <td>{{ $surveillant->nom }}</td>
                            <td>{{ $surveillant->prenom }}</td>
                            <td>{{ $surveillant->email }}</td>
                            <td class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('admin.surveillants.edit', $surveillant->id) }}" class="btn btn-warning btn-sm">✏️</a>

                                <form action="{{ route('admin.surveillants.destroy', $surveillant->id) }}" method="POST" onsubmit="return confirm('Supprimer ce surveillant ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucun surveillant trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ✅ Pagination --}}
            <div class="mt-3">
                {{ $surveillants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
