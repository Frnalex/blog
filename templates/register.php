<?php
$this->title = 'Inscription';

include('set_token.php');

$pseudo = isset($post) ? htmlspecialchars($post->get('pseudo')) : '';
$erreur_pseudo = isset($errors) &&  isset($errors['pseudo']) ? $errors['pseudo'] : '';
?>


<div class="page-title">
    <h1 class="text-lg">Inscription.</h1>
    <p class="text">Vous avez un compte ? <a href="/index.php?route=login" class="link">Connectez-vous !</a></p>
</div>



<div>
    <form class="form" method="POST" action="/index.php?route=register">

        <div class="form-group">
            <input type="text" placeholder="Pseudo" id="pseudo" name="pseudo" value="<?php echo $pseudo ?>">

            <?php if ($erreur_pseudo) { ?>
            <p class="text-alert"><?php echo $erreur_pseudo ?></p>
            <?php } ?>

        </div>

        <div class="form-group">
            <input type="password" placeholder="Mot de passe" id="password" name="password">
        </div>

        <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">

        <input class="btn" type="submit" value="Inscription" id="submit" name="submit">
    </form>

</div>