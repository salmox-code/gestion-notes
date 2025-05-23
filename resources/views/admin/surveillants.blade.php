<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            👮‍♂️ Gestion des Surveillants
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- ➕ Ajouter un surveillant --}}
        <div class="mb-4">
            <a href="{{ route('surveillants.create') }}" class="btn btn-primary">
                ➕ Ajouter un surveillant
            </a>
        </div>

        {{-- ✅ Tableau des surveillants --}}
        <div class="bg-white shadow-md rounded-lg overflow-auto p-4">
            <table class="table table-bordered table-striped w-full">
                <thead class="table-dark text-white bg-gray-800">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surveillants as $surveillant)
                        <tr class="hover:bg-gray-100 transition">
                            <td>{{ $surveillant->nom }}</td>
                            <td>{{ $surveillant->prenom }}</td>
                            <td>{{ $surveillant->email }}</td>
                            <td class="text-center space-x-2">
                                <a href="{{ route('surveillants.edit', $surveillant->id) }}" class="btn btn-warning btn-sm">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('surveillants.destroy', $surveillant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce surveillant ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucun surveillant trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ✅ Pagination horizontale centrée --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $surveillants->links('pagination::bootstrap-4') }}
        </div>

    </div>
</x-app-layout>
