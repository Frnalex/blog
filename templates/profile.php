<?php
include 'set_token.php';
$this->title = 'Mon profil';
echo $this->session->show('update_password');
echo $this->session->show('not_admin'); ?>


<div>
    <h2><?php echo $this->session->get('pseudo'); ?></h2>
    <p><?php echo $this->session->get('id'); ?></p>
    <a href="/index.php?route=updatePassword">Modifier mot de passe</a>
    <a href="/index.php?route=deleteAccount&token=<?php echo $this->session->get('token'); ?>">Supprimer mon compte</a>
</div>
<br>
<a href="/index.php">Retour à l'accueil</a>