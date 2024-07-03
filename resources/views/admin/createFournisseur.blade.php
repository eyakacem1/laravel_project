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
        <div id="dynamic-fields">
            @include('admin.fournisseurDynamicFields', ['type' => request('type', old('type')), 'formeJuridiques' => $formeJuridiques])
        </div>
        <button type="submit" class="btn btn-primary">Ajouter Fournisseur</button>
    </form>
</div>

<script>
    document.addEventListener('change', function(event) {
        if (event.target.matches('input[name="type"]')) {
            var selectedType = event.target.value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fournisseurDynamicFields/' + selectedType, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.getElementById('dynamic-fields').innerHTML = xhr.responseText;
                    clearFieldsIfPhysique(selectedType);
                }
            };
            xhr.send();
        }
    });

    function clearFieldsIfPhysique(type) {
        if (type === 'personne physique') {
            document.querySelectorAll('#dynamic-fields input').forEach(function(input) {
                input.value = '';
            });
            document.querySelectorAll('#dynamic-fields select').forEach(function(select) {
                select.selectedIndex = 0;
            });
        }
    }
</script>
@endsection
