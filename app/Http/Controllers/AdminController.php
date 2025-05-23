<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf; 
use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Surveillant;

class AdminController extends Controller
{
    // 🏠 Dashboard classique
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // 🔘 Traitement des choix du dashboard original
    public function chooseAction(Request $request)
    {
        return match ($request->input('action')) {
            'saisie' => redirect()->route('admin.notes'),
            'pv' => redirect()->route('notes.pv.pdf'),
            'bulletin' => redirect()->route('etudiants.index'),
            default => redirect()->route('admin.dashboard'),
        };
    }

    // ✅ 1. Vue "Gérer Étudiants"
    public function etudiants(Request $request)
{
    $query = Etudiant::with('classe');

    // 🔎 Recherche par nom
    if ($request->filled('search')) {
        $query->where('nom', 'like', '%' . $request->search . '%');
    }

    // 🎓 Filtrage par niveau
    if ($request->filled('niveau')) {
        $query->where('niveau', $request->niveau);
    }

    // 📄 Paginer avec conservation des filtres
    $etudiants = $query->paginate(10)->appends($request->all());

    return view('admin.etudiants', compact('etudiants'));
}


    // ✅ 2. Vue "Gérer Surveillants"
    public function surveillants()
    {
        $surveillants = Surveillant::paginate(10);
        return view('admin.surveillants', compact('surveillants'));
    }

    // ✅ 3. Vue "Saisie Notes & Bulletins"
    public function notes()
    {
        return redirect()->route('admin.saisie.niveau');
    }

    // ✅ 4. Vue "Convocations"
    public function convocations()
    {
         $surveillants = \App\Models\Surveillant::all();
    return view('convocations.create', compact('surveillants'));
    }

    // 🎓 Vue intermédiaire pour choix du niveau/filtrage
    public function choixNiveau()
    {
        return view('admin.saisie_niveau');
    }


    public function genererConvocation(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'jour' => 'required|string',
        'classe' => 'required|string',
        'surveillant_id' => 'required|exists:surveillants,id',
        'salle' => 'required|string',
    ]);

    $surveillant = Surveillant::findOrFail($request->surveillant_id);

    $data = [
        'date' => $request->date,
        'jour' => $request->jour,
        'classe' => $request->classe,
        'salle' => $request->salle,
        'surveillant' => $surveillant,
    ];

    $pdf = Pdf::loadView('admin.convocation_pdf', $data);
    return $pdf->download('convocation_'.$request->classe.'.pdf');
}
    // 🎓 Vue avec les étudiants filtrés et les matières associées
    public function filtrerPourSaisie(Request $request)
    {
        $niveau = $request->niveau;
        $filiere = $request->filiere;

        $query = Etudiant::where('niveau', $niveau);
        if ($niveau === 'Cycle' && $filiere) {
            $query->where('filiere', $filiere);
        }

        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        $etudiants = $query->paginate(10);
        $matieres = Matiere::where('niveau', $niveau)->get();

        return view('admin.saisie_group', compact('etudiants', 'matieres', 'niveau', 'filiere'));
    }

    // ✅ Enregistrement des notes groupées
    public function submitNotes(Request $request)
    {
        foreach ($request->notes as $etudiantId => $noteData) {
            Note::updateOrCreate(
                [
                    'etudiant_id' => $etudiantId,
                    'matiere_id' => $request->matiere_id
                ],
                ['valeur' => $noteData['valeur'] ?? null]
            );
        }

        return redirect()->route('admin.dashboard')->with('success', 'Notes enregistrées avec succès !');
    }
}
