<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surveillant;


class SurveillantController extends Controller
{
  public function index()
    {
        $surveillants = Surveillant::paginate(10);
        return view('surveillants.index', compact('surveillants'));
    }

    public function create()
    {
        return view('surveillants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:surveillants,email',
        ]);

        Surveillant::create($request->all());

        return redirect()->route('admin.surveillants.index')->with('success', 'Surveillant ajouté avec succès.');
    }

    public function edit(Surveillant $surveillant)
    {
        return view('surveillants.edit', compact('surveillant'));
    }

    public function update(Request $request, Surveillant $surveillant)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:surveillants,email,' . $surveillant->id,
        ]);

        $surveillant->update($request->all());

        return redirect()->route('admin.surveillants.index')->with('success', 'Surveillant modifié avec succès.');
    }

    public function destroy(Surveillant $surveillant)
    {
        $surveillant->delete();
        return redirect()->route('admin.surveillants.index')->with('success', 'Surveillant supprimé.');
    }
}
