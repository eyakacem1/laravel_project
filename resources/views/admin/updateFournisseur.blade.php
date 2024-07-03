@extends('layout.master')

@section('content')
<div class="container">
    <style>
        .container {
            margin-top: 15px;
        }
        .hidden {
            display: none;
        }
    </style>
    <h1>Edit Fournisseur</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.fournisseur.update', ['id' => $fournisseur->id]) }}" method="POST" id="editForm">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ $fournisseur->nom }}" required>
        </div>

        <div id="dynamic-fields">
            @include('admin.fournisseurDynamicFields', ['type' => $fournisseur->type, 'fournisseur' => $fournisseur, 'formeJuridiques' => $formeJuridiques])
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

<script>
    document.addEventListener('change', function(event) {
        if (event.target.matches('input[name="type"]')) {
            var selectedType = event.target.value;
            var fournisseurId = {{ $fournisseur->id }};

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fournisseurDynamicFields/' + fournisseurId + '/' + selectedType, true);
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
