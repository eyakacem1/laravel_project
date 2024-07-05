@extends('layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Liste des Villes</h2>
                    <a href="{{ route('admin.villes.create') }}" class="btn btn-primary">Ajouter une Ville</a>
                </div>
                <div class="card-body table-responsive table-footer">

                    <div class="card-body table-responsive">
                   

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($villes as $ville)
                                <tr>
                                    <td>{{ $ville->id }}</td>
                                    <td>{{ $ville->nom }}</td>
                                    <td><div class="d-flex">
                                        <a href="{{ route('admin.villes.edit', $ville->id) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.villes.destroy', $ville->id) }}" method="POST" style="display:inline-block;">
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
