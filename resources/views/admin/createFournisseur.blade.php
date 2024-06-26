@extends('layout.master')

@section('content')
<style>
    .container {
        margin-top: 15%;
    }
</style>

<div class="container">
    <h2>Ajouter un Fournisseur</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.fournisseur.store') }}" method="POST">        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>
        
        <div class="form-group">
            <label for="matriculeFiscale">Matricule Fiscale</label>
            <input type="text" class="form-control" id="matriculeFiscale" name="matriculeFiscale" value="{{ old('matriculeFiscale') }}" required>
        </div>
        <div class="form-group">
            <label for="raisonSociale">Raison Sociale</label>
            <input type="text" class="form-control" id="raisonSociale" name="raisonSociale" value="{{ old('raisonSociale') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Téléphone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        </div>

       

        <div class="form-group">
            <label for="formeJuridique">Forme Juridique</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="formeJuridique_sarl" name="formeJuridique" value="SARL" {{ old('formeJuridique') == 'SARL' ? 'checked' : '' }}>
                <label class="form-check-label" for="formeJuridique_sarl">SARL</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="formeJuridique_sa" name="formeJuridique" value="SA" {{ old('formeJuridique') == 'SA' ? 'checked' : '' }}>
                <label class="form-check-label" for="formeJuridique_sa">SA</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="formeJuridique_sasu" name="formeJuridique" value="SASU" {{ old('formeJuridique') == 'SASU' ? 'checked' : '' }}>
                <label class="form-check-label" for="formeJuridique_sasu">SASU</label>
            </div>        </div>


       

       
     

        <div class="form-group">
            <label>Type</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="type_physique" name="type" value="personne physique" {{ old('type') == 'personne physique' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_physique">Personne Physique</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="type_morale" name="type" value="personne morale" {{ old('type') == 'personne morale' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_morale">Personne Morale</label>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Ajouter Fournisseur</button>
    </form>
</div>
@endsection
