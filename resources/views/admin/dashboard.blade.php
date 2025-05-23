<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            🎓 Espace Administrateur
        </h2>
    </x-slot>

  
@if(session('pwned_password'))
    <div class="alert alert-warning">
        ⚠️ <strong>Mot de passe compromis !</strong><br>
        Ce mot de passe a été détecté dans une fuite de données publique. <br>
        <a href="{{ route('password.edit') }}">👉 Changez-le maintenant</a>
    </div>
@endif




    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ✅ Message de bienvenue --}}
            <div class="bg-white p-6 rounded shadow-sm">
                <p class="text-lg font-semibold text-gray-800">
                    ✅ Bienvenue {{ Auth::user()->name }} !
                </p>
            </div>

            {{-- ✅ Menu en cartes colorées --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- 1️⃣ Gérer Étudiants -->
                <a href="{{ route('admin.etudiants.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-lg shadow text-center transition">
                    <div class="text-4xl mb-2">👨‍🎓</div>
                    <div class="text-lg font-semibold">Gérer Étudiants</div>
                </a>
<!-- surveillant hhh-->
<!-- 👮‍♂️ Gérer Surveillants -->
<a href="{{ route('admin.surveillants.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white p-6 rounded-lg shadow text-center transition">
    <div class="text-4xl mb-2">👮‍♂️</div>
    <div class="text-lg font-semibold">Gérer Surveillants</div>
</a>
                <!-- 2️⃣ Saisie Notes & Bulletins -->
                <a href="{{ route('admin.notes') }}" class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-lg shadow text-center transition">
                    <div class="text-4xl mb-2">📝</div>
                    <div class="text-lg font-semibold">Saisie Notes & Bulletins</div>
                </a>

                <!-- 3️⃣ Convocations -->
                <a href="{{ route('admin.convocations') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-lg shadow text-center transition">
                    <div class="text-4xl mb-2">📅</div>
                    <div class="text-lg font-semibold">Convocation Surveillance</div>
                </a>

                <!-- 📋 Liste des Convocations -->
<a href="{{ route('convocations.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-lg shadow text-center transition">
    <div class="text-4xl mb-2">📋</div>
    <div class="text-lg font-semibold">Liste des Convocations</div>
</a>


            </div>

        </div>
    </div>
</x-app-layout>
