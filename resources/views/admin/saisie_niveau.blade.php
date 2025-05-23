<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎓 Choix du Niveau et de la Filière
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                <form method="POST" action="{{ route('admin.saisie.fetch') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="niveau" class="form-label">Niveau</label>
                        <select name="niveau" id="niveau" class="form-control" required>
                            <option value="">-- Sélectionner un niveau --</option>
                            <option value="CP1">CP1</option>
                            <option value="CP2">CP2</option>
                            <option value="DATA1">Cycle DATA</option>
                            <option value="TDIA1">Cycle TDIA</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">🔍 Rechercher</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

