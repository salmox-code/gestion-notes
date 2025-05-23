<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📘 Liste des matières
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white p-4 rounded shadow">
                @if(count($matieres) > 0)
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Code</th>
                                <th>Semestre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matieres as $matiere)
                                <tr>
                                    <td>{{ $matiere->id }}</td>
                                    <td>{{ $matiere->nom }}</td>
                                    <td>{{ $matiere->code }}</td>
                                    <td>{{ $matiere->semestre }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Aucune matière trouvée.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
