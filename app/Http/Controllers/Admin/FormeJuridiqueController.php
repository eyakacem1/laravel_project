<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormeJuridique;
use Illuminate\Http\Request;

class FormeJuridiqueController extends Controller
{
    public function index()
    {
        $formesjuridiques = FormeJuridique::all();
        return view('admin.formeJuridiques', compact('formesjuridiques'));
    }

    public function create()
    {
        return view('admin.createFormeJuridiques');
    }

    public function store(Request $request)
    {
        $request->validate([
            'forme' => 'required|string|max:255',
        ]);

        FormeJuridique::create($request->all());
        return redirect()->route('admin.formeJuridiques')->with('success', 'Forme Juridique crée avec succès.');
    }

    public function edit($id)
    {
        $formeJuridique = FormeJuridique::findOrFail($id);

        return view('admin.UpdateFormeJuridiques', compact('formeJuridique'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'forme' => 'required|string|max:255',
        ]);
        $formeJuridique = FormeJuridique::findOrFail($id);
        $formeJuridique->update($request->all());
        return redirect()->route('admin.formeJuridiques')->with('success', 'Forme Juridique mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $formeJuridique = FormeJuridique::findOrFail($id);

        $formeJuridique->delete();
        return redirect()->route('admin.formeJuridiques')->with('success', 'Forme Juridique supprimée avec succès.');
    }
}
