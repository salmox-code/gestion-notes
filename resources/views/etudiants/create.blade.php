<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Ajouter un nouvel étudiant
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
@endif


            <div class="bg-white p-6 shadow rounded">
                <form action="{{ route('admin.etudiants.store') }}" method="POST">
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

                    <div class="mb-3">
                        <label for="cne" class="form-label">CNE</label>
                        <input type="text" name="cne" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="niveau" class="form-label">Niveau</label>
                        <select name="niveau" class="form-select" required>
                            <option value="">-- Choisir un niveau --</option>
                            <option value="CP1">CP1</option>
                            <option value="CP2">CP2</option>
                            <option value="DATA1">DATA1</option>
                            <option value="TDIA1">TDIA1</option>
                        </select>
                    </div>

                    

                    <button type="submit" class="btn btn-success w-100">✅ Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
