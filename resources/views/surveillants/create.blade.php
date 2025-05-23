<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Ajouter un surveillant
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 shadow rounded">

            <form method="POST" action="{{ route('admin.surveillants.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="d-flex justify-between">
                    <button type="submit" class="btn btn-success">✅ Enregistrer</button>
                    <a href="{{ route('admin.surveillants.index') }}" class="btn btn-secondary">⬅ Retour</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
