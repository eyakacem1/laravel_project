@extends('layout.master')

@section('content')
<div class="container">
    <h1>Edit Fournisseur</h1>
    <form action="{{ route('admin.fournisseur.update', $fournisseur->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $fournisseur->nom }}" required>
        </div>
        <div class="form-group">
            <label for="matriculeFiscale">Matricule Fiscale</label>
            <input type="text" class="form-control" id="matriculeFiscale" name="matriculeFiscale" value="{{ $fournisseur->matriculeFiscale }}" required>
        </div>
        <div class="form-group">
            <label for="raisonSociale">Raison Sociale</label>
            <input type="text" class="form-control" id="raisonSociale" name="raisonSociale" value="{{ $fournisseur->raisonSociale }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $fournisseur->email }}" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $fournisseur->adresse }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $fournisseur->phone }}" required>
        </div>
        <div class="form-group">
            <label for="formeJuridique">Forme Juridique</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="formeJuridique_sarl" name="formeJuridique" value="SARL" {{ $fournisseur->formeJuridique == 'SARL' ? 'checked' : '' }}>
                <label class="form-check-label" for="formeJuridique_sarl">SARL</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="formeJuridique_sa" name="formeJuridique" value="SA" {{ $fournisseur->formeJuridique == 'SA' ? 'checked' : '' }}>
                <label class="form-check-label" for="formeJuridique_sa">SA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="formeJuridique_sasu" name="formeJuridique" value="SASU" {{ $fournisseur->formeJuridique == 'SASU' ? 'checked' : '' }}>
                <label class="form-check-label" for="formeJuridique_sasu">SASU</label>
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="type_physique" name="type" value="personne physique" {{ $fournisseur->type == 'personne physique' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_physique">Personne Physique</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="type_morale" name="type" value="personne morale" {{ $fournisseur->type == 'personne morale' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_morale">Personne Morale</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Fournisseur</button>
    </form>
</div>
@endsection
