<h2><?php echo $TitreDeLaPage ?></h2>

<?php if ($TitreDeLaPage == 'Saisie incorrecte'): ?>
    <div class="alert alert-danger">
        <?= service('validation')->listErrors(); ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('seconnecter') ?>" method="POST">
    <?= csrf_field(); ?>
    
    <div class="mb-3">
        <label for="txtMEL" class="form-label">MEL</label>
        <input type="email" class="form-control" id="txtMEL" name="txtMEL" value="<?= set_value('txtMEL'); ?>" required>
    </div>

    <div class="mb-3">
        <label for="txtMotDePasse" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="txtMotDePasse" name="txtMotDePasse" value="<?= set_value('txtMotDePasse'); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>