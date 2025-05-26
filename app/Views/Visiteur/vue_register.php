<h2><?= $TitreDeLaPage ?></h2>

<form action="<?= base_url('register') ?>" method="POST">
    <?= csrf_field(); ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="txtNom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="txtNom" name="txtNom" value="<?= set_value('txtNom'); ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="txtPrenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="txtPrenom" name="txtPrenom" value="<?= set_value('txtPrenom'); ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="txtAdresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="txtAdresse" name="txtAdresse" value="<?= set_value('txtAdresse'); ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="txtCodepostal" class="form-label">Code postal</label>
            <input type="text" class="form-control" id="txtCodepostal" name="txtCodepostal" value="<?= set_value('txtCodepostal'); ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="txtVille" class="form-label">Ville</label>
            <input type="text" class="form-control" id="txtVille" name="txtVille" value="<?= set_value('txtVille'); ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="txtTelephonefixe" class="form-label">Téléphone fixe</label>
            <input type="text" class="form-control" id="txtTelephonefixe" name="txtTelephonefixe" value="<?= set_value('txtTelephonefixe'); ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="txtTelephonemobile" class="form-label">Téléphone mobile</label>
            <input type="text" class="form-control" id="txtTelephonemobile" name="txtTelephonemobile" value="<?= set_value('txtTelephonemobile'); ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="txtMEL" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="txtMEL" name="txtMEL" value="<?= set_value('txtMEL'); ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="txtMotdepasse" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="txtMotdepasse" name="txtMotdepasse" value="<?= set_value('txtMotdepasse'); ?>" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
