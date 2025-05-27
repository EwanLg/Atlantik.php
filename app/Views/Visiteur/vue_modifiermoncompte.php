<div class="container mt-4">
    <h2>Modifier mes informations</h2>
    <form method="post" action="<?= site_url('modifiermoncompte') ?>">
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" value="<?= esc($utilisateur->NOM) ?>" required>
        </div>
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" value="<?= esc($utilisateur->PRENOM) ?>" required>
        </div>
        <div class="form-group">
            <label>Adresse</label>
            <input type="text" name="adresse" class="form-control" value="<?= esc($utilisateur->ADRESSE) ?>" required>
        </div>
        <div class="form-group">
            <label>Code Postal</label>
            <input type="text" name="codepostal" class="form-control" value="<?= esc($utilisateur->CODEPOSTAL) ?>" required>
        </div>
        <div class="form-group">
            <label>Ville</label>
            <input type="text" name="ville" class="form-control" value="<?= esc($utilisateur->VILLE) ?>" required>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" id="active_fixe" name="active_fixe" <?= $utilisateur->TELEPHONEFIXE ? 'checked' : '' ?>>
                Téléphone fixe
            </label>
            <input type="text" id="telephonefixe" name="telephonefixe" class="form-control" value="<?= esc($utilisateur->TELEPHONEFIXE ?? '') ?>">
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" id="active_mobile" name="active_mobile" <?= $utilisateur->TELEPHONEMOBILE ? 'checked' : '' ?>>
                Téléphone mobile
            </label>
            <input type="text" id="telephonemobile" name="telephonemobile" class="form-control" value="<?= esc($utilisateur->TELEPHONEMOBILE ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="text" name="motdepasse" class="form-control" value="<?= esc($utilisateur->MOTDEPASSE ?? '') ?>">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
            <a href="<?= site_url('moncompte') ?>" class="btn btn-secondary ml-2">Annuler</a>
        </div>
    </form>
</div>

<script>
    function toggleInput(checkboxId, inputId) {
        const checkbox = document.getElementById(checkboxId);
        const input = document.getElementById(inputId);

        function update() {
            if (checkbox.checked) {
                input.disabled = false;
                input.classList.remove('text-muted');
            } else {
                input.disabled = true;
                input.classList.add('text-muted');
            }
        }

        checkbox.addEventListener('change', update);
        update();admin
    }

    toggleInput('active_fixe', 'telephonefixe');
    toggleInput('active_mobile', 'telephonemobile');
</script>

<style>
    input.text-muted {
        background-color: #e9ecef;
        color: #6c757d;
    }
</style>
