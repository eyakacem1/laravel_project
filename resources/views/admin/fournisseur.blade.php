@extends('layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">liste des fournisseurs</h3>
                    <a class="btn btn-primary" href="{{ route('admin.fournisseur.create') }}">Ajouter Étudiant</a>

                </div>
                <div class="card-body table-responsive table-footer">

                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Code Fournisseur</th>
                                    <th scope="col">Matricule Fiscale</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Raison Sociale</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Forme Juridique</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fournisseur as $f)
                                    <tr>
                                        <td>{{ $f->code }}</td>
                                        <td>{{ $f->matriculeFiscale }}</td>
                                        <td>{{ $f->nom }}</td>
                                        <td>{{ $f->raisonSociale }}</td>

                                        <!-- Output additional fields here -->
                                        <td>{{ $f->adresse }}</td>
                                        <td>{{ $f->email }}</td>
                                        <td>{{ $f->phone }}</td>
                                        <td>{{ $f->formeJuridique }}</td>

                                        <td>{{ $f->type }}</td>
                                        <td><div class="d-flex">
                            

                                            <a href="{{ route('admin.fournisseur.edit', ['id' => $f->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                                
                                            <form action="{{ route('admin.fournisseur.destroy', ['id' => $f->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                            </form>
                                            
                                        </div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
