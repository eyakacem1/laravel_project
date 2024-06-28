@extends('layout.master')

@section('content')
<style>
    .container {
        margin-top: 15%;
    }

    .hidden {
        display: none;
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

    <form id="fournisseurForm" action="{{ route('admin.fournisseur.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="hidden" name="table_name" value="fournisseur">
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
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
            <label for="ville">Ville</label>
            <select class="form-control" id="ville" name="ville" required>
                <option value="">Sélectionner une ville</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ old('ville') == $ville->id ? 'selected' : '' }}>{{ $ville->nom }}</option>
                @endforeach
            </select>
        </div>

        <div id="personneMoraleFields" class="hidden">
            <div class="form-group">
                <label for="matriculeFiscale">Matricule Fiscale</label>
                <input type="text" class="form-control" id="matriculeFiscale" name="matriculeFiscale" value="{{ old('matriculeFiscale') }}">
            </div>
            <div class="form-group">
                <label for="raisonSociale">Raison Sociale</label>
                <input type="text" class="form-control" id="raisonSociale" name="raisonSociale" value="{{ old('raisonSociale') }}">
            </div>
            <div class="form-group">
                <label for="formeJuridique">Forme Juridique</label>
                <select class="form-control" id="formeJuridique" name="formeJuridique" required>
                    <option value="">Sélectionner une forme juridique</option>
                    @foreach($formeJuridiques as $id => $forme)
                        <option value="{{ $id }}" {{ old('formeJuridique') == $id ? 'selected' : '' }}>{{ $forme }}</option>
                    @endforeach
                </select>
                
            </div>
        </div>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const personneMoraleFields = document.getElementById('personneMoraleFields');
        const typePhysiqueRadio = document.getElementById('type_physique');
        const typeMoraleRadio = document.getElementById('type_morale');

        function togglePersonneMoraleFields() {
            personneMoraleFields.classList.toggle('hidden', !typeMoraleRadio.checked);
        }

        togglePersonneMoraleFields();

        typePhysiqueRadio.addEventListener('change', togglePersonneMoraleFields);
        typeMoraleRadio.addEventListener('change', togglePersonneMoraleFields);
    });
</script>
@endsection
