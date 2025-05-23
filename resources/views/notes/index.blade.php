<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 Liste des notes
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif

            <a href="{{ route('notes.pv') }}" class="btn btn-dark mb-4">📄 Télécharger le PV en PDF</a>

            <div class="bg-white p-4 rounded shadow">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Étudiant</th>
                            <th>Matière</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $note)
                            <tr>
                                <td>{{ $note->etudiant->nom }} {{ $note->etudiant->prenom }}</td>
                                <td>{{ $note->matiere->nom }}</td>
                                <td>{{ $note->valeur }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

