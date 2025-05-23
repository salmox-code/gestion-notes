<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            📋 Liste des convocations
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow-sm">

            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Classe</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Salle</th>
                        <th>Surveillant</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($convocations as $convocation)
                        <tr>
                            <td>{{ $convocation->id }}</td>
                            <td>{{ $convocation->niveau }}</td>
                            <td>{{ $convocation->date }}</td>
                            <td>{{ $convocation->heure }}</td>
                            <td>{{ $convocation->salle->nom }}</td>
                            <td>{{ $convocation->surveillant->prenom }} {{ $convocation->surveillant->nom }}</td>
                            <td class="d-flex gap-1 flex-wrap">
                                <a href="{{ route('convocations.pdf', $convocation->id) }}" class="btn btn-sm btn-primary">📄 PDF</a>
                                <form action="{{ route('convocations.destroy', $convocation->id) }}" method="POST" onsubmit="return confirm('Supprimer cette convocation ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aucune convocation trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
