@extends('layout.master')

@section('content')
<div class="container">
    <h2>Ajouter une Ville</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.villes.update', ['id' => $ville->id]) }}" method="POST">
        @csrf
        @method('put')
            <div class="form-group">
            <label for="nom">Nom de la Ville</label>
            <input type="text" class="form-control"value="{{ $ville->nom}}" id="nom" name="nom" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
