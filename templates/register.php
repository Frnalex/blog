<?php
$this->title = 'Inscription';

$pseudo = isset($post) ? htmlspecialchars($post->get('pseudo')) : '';
?>

<div>
    <form method="POST" action="../public/index.php?route=register">

        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo $pseudo ?>">

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">

        <input type="submit" value="Inscription" id="submit" name="submit">

    </form>

    <a href="../public/index.php">Retour à l'accueil</a>
</div>