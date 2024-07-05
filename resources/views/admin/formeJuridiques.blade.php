@extends('layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Liste des Formes Juridiques</h2>
                    <a href="{{ route('admin.formeJuridiques.create') }}" class="btn btn-primary">Ajouter une Forme Juridique</a>
                </div>
                <div class="card-body table-responsive table-footer">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Forme</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formesjuridiques as $forme)
                                <tr>
                                    <td>{{ $forme->id }}</td>
                                    <td>{{ $forme->forme }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.formeJuridiques.edit', $forme->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.formeJuridiques.destroy', $forme->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
