<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;
use App\Models\Parametre;


class FournisseurResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseur = Fournisseur::all();
        return view('admin.fournisseur.index', compact('fournisseur'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.createFournisseur');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'adresse' => 'required|string',
            'email' => 'required|email',
            'formeJuridique' => 'required|string',
            'matriculeFiscale' => 'required|string',
            'nom' => 'required|string',
            'phone' => 'required|string',
            'raisonSociale' => 'required|string',
            'type' => 'required|string',
        ]);

        $id = $this->generate_code();

        $fournisseur = new Fournisseur();
        $fournisseur->id = $id;
        $fournisseur->adresse = $request->adresse;
        $fournisseur->email = $request->email;
        $fournisseur->formeJuridique = $request->formeJuridique;
        $fournisseur->matriculeFiscale = $request->matriculeFiscale;
        $fournisseur->nom = $request->nom;
        $fournisseur->phone = $request->phone;
        $fournisseur->raisonSociale = $request->raisonSociale;
        $fournisseur->type = $request->type;
        $fournisseur->save();

        return redirect()->route('admin.fournisseur.create')->with('success', 'Fournisseur ajouté avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.fournisseur.show', compact('fournisseur'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.fournisseur.edit', compact('fournisseur'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->name = $request->input('name');
        $fournisseur->save();

        return redirect()->route('fournisseur.index');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();

        return redirect()->route('fournisseur.index');
        //
    }
    private function generate_code()
    {
        $parametre = Parametre::first(); // Adjust as per your application logic to fetch the appropriate parametre

        // Generate a unique ID using prefixe and compteur
        $id = $parametre->prefixe . '-' . $parametre->compteur;
    
        // Increment compteur for the next use, assuming it's a sequential counter
        $parametre->compteur++;
    
        // Save the updated parametre
        $parametre->save();
    
        return $id;
    }
}
