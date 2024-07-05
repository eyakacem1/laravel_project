<div class="personne-morale-fields" style="display: none;">
    <div class="form-group">
        <label for="matriculeFiscale">Matricule Fiscale</label>
        <input type="text" class="form-control" id="matriculeFiscale" name="matriculeFiscale" value="{{ $fournisseur->matriculeFiscale }}">
    </div>
    <div class="form-group">
        <label for="raisonSociale">Raison Sociale</label>
        <input type="text" class="form-control" id="raisonSociale" name="raisonSociale" value="{{ $fournisseur->raisonSociale }}">
    </div>
    <div class="form-group">
        <label for="formeJuridique">Forme Juridique</label>
        <select class="form-control" id="formeJuridique" name="formeJuridique" required>
            <option value="">Sélectionner une forme juridique</option>
            @foreach($formeJuridiques as $formeJuridique)
                <option value="{{ $formeJuridique->forme }}" {{ $fournisseur->formeJuridique == $formeJuridique->forme ? 'selected' : '' }}>
                    {{ $formeJuridique->forme }}
                </option>
            @endforeach
        </select>
    </div>
</div>
