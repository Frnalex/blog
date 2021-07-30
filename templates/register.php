<?php
$this->title = 'Inscription';

include('set_token.php');

$pseudo = isset($post) ? htmlspecialchars($post->get('pseudo')) : '';
$erreur_pseudo = isset($errors) &&  isset($errors['pseudo']) ? $errors['pseudo'] : '';
?>



<div>
    <form method="POST" action="/index.php?route=register">

        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo $pseudo ?>">
        <?php echo $erreur_pseudo ?>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">

        <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">


        <input type="submit" value="Inscription" id="submit" name="submit">

    </form>

    <a href="/index.php">Retour à l'accueil</a>
</div>