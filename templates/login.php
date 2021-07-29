<?php
$this->title = 'Connexion';
echo $this->session->show('error_login');
echo $this->session->show('need_login');

$pseudo = isset($post) ? htmlspecialchars($post->get('pseudo')) : '';
?>

<div>
    <form method="POST" action="/index.php?route=login">

        <label for="pseudo">Pseudo</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo $pseudo ?>"><br>

        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Connexion" id="submit" name="submit">

    </form>

    <a href="/index.php">Retour à l'accueil</a>
</div>