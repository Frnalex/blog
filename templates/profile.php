<?php $this->title = 'Mon profil'; ?>
<?php echo $this->session->show('update_password') ?>


<div>
    <h2><?php echo $this->session->get('pseudo') ?></h2>
    <p><?php echo $this->session->get('id') ?></p>
    <a href="../public/index.php?route=updatePassword">Modifier mot de passe</a>
</div>
<br>
<a href="../public/index.php">Retour à l'accueil</a>