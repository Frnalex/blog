<?php
$this->title = 'Connexion';

include('set_token.php');

$pseudo = isset($post) ? htmlspecialchars($post->get('pseudo')) : '';
?>

<div class="page-title">
    <h1 class="text-lg">Connexion.</h1>
    <p class="text">Pas de compte ? <a href="/index.php?route=register" class="link">Inscrivez-vous !</a></p>
</div>

<div>
    <form class="form" method="POST" action="/index.php?route=login">

        <?php
        if ($this->session->get('error_login')) {
            echo '<p class="text-alert">' . $this->session->show('error_login') . '</p>';
        }
        if ($this->session->get('need_login')) {
            echo '<p class="text-alert">' . $this->session->show('need_login') . '</p>';
        }
        ?>

        <div class="form-group">
            <input type="text" placeholder="Pseudo" id="pseudo" name="pseudo" value="<?php echo $pseudo ?>">
        </div>

        <div class="form-group">
            <input type="password" placeholder="Mot de passe" id="password" name="password">
        </div>

        <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">


        <input class="btn" type="submit" value="Connexion" id="submit" name="submit">

    </form>
</div>