<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📅 Nouvelle convocation à la surveillance
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 shadow rounded">

            {{-- ✅ Notification de succès --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ❌ Affichage erreurs --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>❌ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ Formulaire de convocation --}}
            <form method="POST" action="{{ route('convocations.store')}}">
                @csrf

                {{-- Niveau (classe) --}}
                <div class="mb-3">
                    <label for="niveau" class="form-label">Classe concernée</label>
                    <select name="niveau" class="form-select" required>
                        <option value="">-- Sélectionner une classe --</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe }}" {{ old('niveau') == $classe ? 'selected' : '' }}>
                                {{ $classe }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date --}}
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>

                {{-- Heure --}}
                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" name="heure" value="{{ old('heure') }}" class="form-control" required>
                </div>

                {{-- Salle --}}
                <div class="mb-3">
                    <label for="salle_id" class="form-label">Salle</label>
                    <select name="salle_id" class="form-select" required>
                        <option value="">-- Choisir une salle --</option>
                        @foreach($salles as $salle)
                            <option value="{{ $salle->id }}" {{ old('salle_id') == $salle->id ? 'selected' : '' }}>
                                {{ $salle->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Surveillant --}}
                <div class="mb-4">
                    <label for="surveillant_id" class="form-label">Surveillant</label>
                    <select name="surveillant_id" class="form-select" required>
                        <option value="">-- Sélectionner un surveillant --</option>
                        @foreach($surveillants as $surveillant)
                            <option value="{{ $surveillant->id }}" {{ old('surveillant_id') == $surveillant->id ? 'selected' : '' }}>
                                {{ $surveillant->prenom }} {{ $surveillant->nom }} ({{ $surveillant->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">📤 Créer et envoyer</button>
            </form>
        </div>
    </div>
</x-app-layout>
