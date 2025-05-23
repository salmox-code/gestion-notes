<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $query = Etudiant::query();

    // Recherche par nom
    if ($request->filled('search')) {
        $query->where('nom', 'like', '%' . $request->search . '%');
    }

    // Filtrage par niveau et filière
    if ($request->filled('niveau')) {
        $query->where('niveau', $request->niveau);
    }

    if ($request->filled('filiere')) {
        $query->where('filiere', $request->filiere);
    }

    $etudiants = $query->orderBy('nom')->paginate(10);

    return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        return view('etudiants.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:etudiants',
        'cne' => 'required|string|unique:etudiants',
        'niveau' => 'required|string',
    ]);

    // ✅ Associer automatiquement classe_id selon le niveau
    $niveau = $request->niveau;

    $classeMap = [
        'CP1' => 1,
        'CP2' => 2,
        'DATA1' => 3,
        'TDIA1' => 4,
    ];

    $classeId = $classeMap[$niveau] ?? null; // null au cas où niveau inconnu

    // ✅ Création de l'étudiant avec affectation automatique de la classe
    Etudiant::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'cne' => $request->cne,
        'niveau' => $niveau,
        'classe_id' => $classeId,
    ]);

    return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant ajouté avec succès !');
}


    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        return view('etudiants.edit', compact('etudiant'));
    }

  public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email',
        'cne' => 'required|string',
        'niveau' => 'required|string',
    ]);

    $etudiant = Etudiant::findOrFail($id);

    // mapping automatique de classe_id
    $classeMap = [
        'CP1' => 1,
        'CP2' => 2,
        'DATA1' => 3,
        'TDIA1' => 4,
    ];

    $etudiant->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'cne' => $request->cne,
        'niveau' => $request->niveau,
        'classe_id' => $classeMap[$request->niveau] ?? null,
    ]);
    



    return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant modifié avec succès !');
}



    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();
        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant supprimé avec succès!');
    }
    public function filtrerPourSaisie(Request $request)
{
    $niveau = $request->niveau;
    $filiere = $request->filiere;

    $query = Etudiant::query();

    // Filtrer selon le niveau et filière si cycle
    if ($niveau === 'Cycle' && $filiere) {
        $query->where('niveau', 'Cycle')->where('filiere', $filiere);
    } else {
        $query->where('niveau', $niveau);
    }

    // Recherche par nom
    if ($request->filled('search')) {
        $query->where('nom', 'like', '%' . $request->search . '%');
    }

    $etudiants = $query->paginate(10);
    return view('admin.etudiants_saisie', compact('etudiants', 'niveau', 'filiere'));
}

}
