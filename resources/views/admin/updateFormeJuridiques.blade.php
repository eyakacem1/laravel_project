@extends('layout.master')

@section('content')
<div class="container">
    <h2>Modifier une Forme Juridique</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.formeJuridiques.update', ['id' => $formeJuridique->id]) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="forme">Forme Juridique</label>
            <input type="text" class="form-control" value="{{ $formeJuridique->forme }}" id="forme" name="forme" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
@endsection
