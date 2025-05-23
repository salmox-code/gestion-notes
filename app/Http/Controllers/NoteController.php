<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\BulletinEtudiantMail;


class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('etudiant', 'matiere')->get();
        return view('notes.index', compact('notes'));
    }

   

    public function updateNotes(Request $request)
{
    $request->validate([
        'etudiant_id' => 'required|exists:etudiants,id',
        'notes' => 'required|array',
        'notes.*' => 'required|numeric|between:0,20',
    ], [
        'notes.*.required' => 'Veuillez saisir une note.',
        'notes.*.numeric' => 'Chaque note doit être un nombre.',
        'notes.*.between' => 'La note doit être entre 0 et 20.',
    ]);

    $etudiantId = $request->etudiant_id;

    foreach ($request->notes as $matiereId => $valeur) {
        Note::updateOrCreate(
            ['etudiant_id' => $etudiantId, 'matiere_id' => $matiereId],
            ['valeur' => number_format((float) $valeur, 2, '.', '')]
        );
    }

    return back()->with('success', 'Toutes les notes ont été enregistrées ou mises à jour.');
}


    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'matiere_id' => 'required|exists:matieres,id',
            'valeur' => 'required|numeric|min:0|max:20'
        ]);

        Note::updateOrCreate(
            ['etudiant_id' => $request->etudiant_id, 'matiere_id' => $request->matiere_id],
            ['valeur' => $request->valeur]
        );

        return redirect()->route('notes.create', ['etudiant_id' => $request->etudiant_id])
                         ->with('success', 'Note enregistrée ou modifiée avec succès');
    }

    public function editNotes(Request $request)
    {
        $etudiant = Etudiant::findOrFail($request->etudiant_id);
        $niveau = $etudiant->niveau;
    
        // ✅ Récupère toutes les matières du niveau
        $matieres = Matiere::where('niveau', $niveau)->get();
    
        // ✅ Récupère les notes existantes de l'étudiant
        $notesExistantes = Note::where('etudiant_id', $etudiant->id)
                               ->pluck('valeur', 'matiere_id');
    
        // ✅ Toujours afficher la vue, même si toutes les matières sont déjà notées
        return view('notes.edit_notes', compact('etudiant', 'niveau', 'matieres', 'notesExistantes'));
    }
    

    public function destroy(Request $request)
    {
        Note::where('etudiant_id', $request->etudiant_id)
            ->where('matiere_id', $request->matiere_id)
            ->delete();

        return redirect()->route('notes.create', ['etudiant_id' => $request->etudiant_id])
                         ->with('success', 'Note supprimée avec succès');
    }

    public function genererPV()
    {
        $notes = Note::with('etudiant', 'matiere')->get();
        return view('notes.pv', compact('notes'));
    }

    public function exporterPV()
    {
        $notes = Note::with('etudiant', 'matiere')->get();
        $pdf = Pdf::loadView('notes.pv', compact('notes'));

        return $pdf->download('proces-verbal-notes.pdf');
    }

    public function bulletin($etudiant_id)
    {
        $etudiant = Etudiant::findOrFail($etudiant_id);
        $notes = Note::with('matiere')->where('etudiant_id', $etudiant_id)->get();

        $moyenne = $notes->avg('valeur');
        $mention = $moyenne >= 10 ? '✅ Validé' : '❌ Ajourné';

        $pdf = Pdf::loadView('notes.bulletin', compact('etudiant', 'notes', 'moyenne', 'mention'));

        return $pdf->download('bulletin_' . $etudiant->nom . '_' . $etudiant->prenom . '.pdf');
    }

    public function saisirNotes(Request $request)
    {
        $classe = $request->input('classe');
        $matiere = $request->input('matiere_id');

        $etudiants = Etudiant::where('classe', $classe)->get();

        return view('admin.notes.saisie', compact('etudiants', 'classe', 'matiere'));
    }

    public function storeNotes(Request $request)
    {
        $notes = $request->input('notes');

        if (!$notes || !is_array($notes)) {
            return back()->with('error', 'Aucune note reçue. Vérifiez le formulaire.');
        }

        foreach ($notes as $etudiant_id => $note) {
            Note::updateOrCreate(
                ['etudiant_id' => $etudiant_id, 'matiere_id' => $request->matiere_id],
                ['valeur' => $note]
            );
        }

        return redirect()->route('notes.index')->with('success', 'Notes enregistrées avec succès.');
    }
    public function envoyerBulletin(Request $request, $etudiant_id)
{
    $etudiant = Etudiant::with('notes.matiere')->findOrFail($etudiant_id);
    $notes = $etudiant->notes;

    $moyenne = $notes->avg('valeur');
    $mention = $moyenne >= 10 ? '✅ Validé' : '❌ Ajourné';

    $pdf = Pdf::loadView('notes.bulletin', compact('etudiant', 'notes', 'moyenne', 'mention'));
    Mail::to($etudiant->email)->send(new BulletinEtudiantMail($pdf, $etudiant));

    // 🔁 Revenir vers la vue saisie_group avec les bons paramètres
   return redirect()->route('admin.saisie.fetch', [
    'niveau' => $etudiant->niveau,
    'search' => '', 
])->with('success', '📧 Bulletin PDF envoyé à ' . $etudiant->prenom);



}
}