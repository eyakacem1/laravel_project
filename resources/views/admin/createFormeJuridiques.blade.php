@extends('layout.master')

@section('content')
<style>
    .container {
        margin-top: 15%;
    }
</style>

<div class="container">
    <h2>Ajouter une Forme Juridique</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.formeJuridiques.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="forme">Forme Juridique</label>
            <input type="text" class="form-control" id="forme" name="forme" value="{{ old('forme') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter Forme Juridique</button>
    </form>
</div>
@endsection
