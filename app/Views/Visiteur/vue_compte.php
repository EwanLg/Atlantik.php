<div class="container mt-4">
    <h2>Mon Compte</h2>
    <hr>

    <div class="row mb-2"><div class="col-sm-4 font-weight-bold">Nom :</div><div class="col-sm-8"><?= esc($utilisateur->NOM) ?></div></div>
    <div class="row mb-2"><div class="col-sm-4 font-weight-bold">Prénom :</div><div class="col-sm-8"><?= esc($utilisateur->PRENOM) ?></div></div>
    <div class="row mb-2"><div class="col-sm-4 font-weight-bold">Adresse :</div><div class="col-sm-8"><?= esc($utilisateur->ADRESSE) ?></div></div>
    <div class="row mb-2"><div class="col-sm-4 font-weight-bold">Code Postal :</div><div class="col-sm-8"><?= esc($utilisateur->CODEPOSTAL) ?></div></div>
    <div class="row mb-2"><div class="col-sm-4 font-weight-bold">Ville :</div><div class="col-sm-8"><?= esc($utilisateur->VILLE) ?></div></div>
    <div class="row mb-2"><div class="col-sm-4 font-weight-bold">Téléphone fixe :</div><div class="col-sm-8"><?= esc($utilisateur->TELEPHONEFIXE ?? 'Non renseigné') ?></div></div>
    <div class="row mb-2"><div class="col-sm-4 font-weight-bold">Téléphone mobile :</div><div class="col-sm-8"><?= esc($utilisateur->TELEPHONEMOBILE ?? 'Non renseigné') ?></div></div>

    <div class="mt-4">
        <a href="<?= site_url('modifiermoncompte') ?>" class="btn btn-primary">Modifier mes informations</a>
    </div>
</div>
