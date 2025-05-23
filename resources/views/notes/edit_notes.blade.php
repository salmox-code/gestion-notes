<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Saisie ou modification des notes de : {{ $etudiant->nom }} — Niveau : {{ $niveau }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">

                {{-- ✅ Message de succès --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                {{-- ❌ Message d’erreur --}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                {{-- ✅ Formulaire --}}
                <form action="{{ route('notes.updateNotes') }}" method="POST">
                    @csrf
                    <input type="hidden" name="etudiant_id" value="{{ $etudiant->id }}">

                    <table class="table table-bordered mt-4">
                        <thead class="table-dark">
                            <tr>
                                <th>Matière</th>
                                <th>Note (/20)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($matieres as $matiere)
                                <tr>
                                    <td>{{ $matiere->nom }}</td>
                                    <td>
                                        <input type="number"
       name="notes[{{ $matiere->id }}]"
       value="{{ old('notes.' . $matiere->id, number_format($notesExistantes[$matiere->id] ?? '', 2)) }}"
       class="form-control {{ isset($notesExistantes[$matiere->id]) ? 'is-valid' : '' }}"
       min="0" max="20" step="0.01">

@error('notes.' . $matiere->id)
    <small class="text-danger">{{ $message }}</small>
@enderror

@if(isset($notesExistantes[$matiere->id]))
    <small class="text-success">
        ✅ Note existante : {{ number_format($notesExistantes[$matiere->id], 2) }}
    </small>
@endif

                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        ⚠️ Toutes les notes sont déjà remplies pour cet étudiant.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($matieres->isNotEmpty())
                        <button type="submit" class="btn btn-primary">💾 Enregistrer toutes les notes</button>
                    @endif

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-2">⬅ Retour</a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
