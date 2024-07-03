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

    <form id="fournisseurForm" action="{{ route('admin.fournisseur.store') }}" method="POST">
        @csrf
        <input type="hidden" name="type" value="{{ request('type', old('type')) }}">

        <div class="form-group">
            <label for="nom">Nom</label>
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
        <div class="form-group">
            <label>Type</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="type_physique" name="type" value="personne physique" {{ request('type') == 'personne physique' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_physique">Personne Physique</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="type_morale" name="type" value="personne morale" {{ request('type') == 'personne morale' ? 'checked' : '' }}>
                <label class="form-check-label" for="type_morale">Personne Morale</label>
            </div>
        </div>
        <div class="form-group" id="matriculeGroup" style="display: none;">
            <label for="matriculeFiscale">Matricule Fiscale</label>
            <input type="text" class="form-control" id="matriculeFiscale" name="matriculeFiscale" value="{{ old('matriculeFiscale') }}">
        </div>
        <div class="form-group" id="raisonGroup" style="display: none;">
            <label for="raisonSociale">Raison Sociale</label>
            <input type="text" class="form-control" id="raisonSociale" name="raisonSociale" value="{{ old('raisonSociale') }}">
        </div>
        <div class="form-group" id="formeGroup" style="display: none;">
            <label for="formeJuridique">Forme Juridique</label>
            <select class="form-control" id="formeJuridique" name="formeJuridique">
                <option value="">Sélectionner une forme juridique</option>
                @foreach($formeJuridiques as $formeJuridique)
                    <option value="{{ $formeJuridique->forme }}" {{ old('formeJuridique') == $formeJuridique->forme ? 'selected' : '' }}>
                        {{ $formeJuridique->forme }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Fournisseur</button>
    </form>
</div>
   <script>
    document.querySelectorAll('input[name="type"]').forEach((elem) => {
        elem.addEventListener('change', function() {
            const matriculeGroup = document.getElementById('matriculeGroup');
            const raisonGroup = document.getElementById('raisonGroup');
            const formeGroup = document.getElementById('formeGroup');

            if (this.value === 'personne morale') {
                matriculeGroup.style.display = 'block';
                raisonGroup.style.display = 'block';
                formeGroup.style.display = 'block';
            } else {
                matriculeGroup.style.display = 'none';
                raisonGroup.style.display = 'none';
                formeGroup.style.display = 'none';
            }
        });
    });

    // Trigger change event on page load to handle pre-selected type
    document.querySelector('input[name="type"]:checked').dispatchEvent(new Event('change'));

</script>

@endsection
