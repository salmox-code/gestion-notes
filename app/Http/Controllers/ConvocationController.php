<?php

namespace App\Http\Controllers;

use App\Models\Convocation;
use App\Mail\ConvocationEnvoyee;
use App\Models\Salle;
use App\Models\Surveillant;
use Illuminate\Http\Request;
use App\Mail\ConvocationSurveillantMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;


class ConvocationController extends Controller
{
   
    // Afficher la liste des convocations
    public function index()
    {
          $convocations = Convocation::with(['salle', 'surveillant'])->latest()->get();
    return view('convocations.index', compact('convocations'));
    }

    // Afficher le formulaire de création
    public function create()
{
    $salles = Salle::all();
    $surveillants = Surveillant::all();
    $classes = ['CP1', 'CP2', 'DATA1', 'TDIA1'];
    return view('convocations.create', compact('salles', 'surveillants', 'classes'));
    

}



           public function destroy($id)
{
    $convocation = Convocation::findOrFail($id);
    $convocation->delete();
    return redirect()->route('convocations.index')->with('success', 'Convocation supprimée avec succès.');
}

public function downloadPdf($id)
{
    $convocation = Convocation::with(['salle', 'surveillant'])->findOrFail($id);
    $pdf = Pdf::loadView('convocations.pdf', compact('convocation'));
    return $pdf->download("convocation_{$convocation->id}.pdf");
}
    // Traiter la soumission du formulaire
   public function store(Request $request)
{
    $request->validate([
        'niveau' => 'required|string',
        'date' => 'required|date|after_or_equal:today',
        'heure' => 'required',
        'salle_id' => [
            'required',
            'exists:salles,id',
            Rule::unique('convocations')->where(fn($q) => $q->where('date', $request->date)->where('heure', $request->heure)),
        ],
        'surveillant_id' => [
            'required',
            'exists:surveillants,id',
            Rule::unique('convocations')->where(fn($q) => $q->where('date', $request->date)->where('heure', $request->heure)),
        ],
    ]);

    $convocation = Convocation::create($request->all());

    // ✅ Envoi mail avec pièce jointe via Mailable
   



Mail::to($convocation->surveillant->email)
    ->send(new ConvocationSurveillantMail($convocation)); 


    return redirect()->route('convocations.index')->with('success', 'Convocation créée et envoyée avec succès.');
}

}


