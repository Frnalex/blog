<?php $this->title = 'Nouvel article'; ?>

<div>
    <form method="POST" action="../public/index.php?route=addArticle">

        <label for="title">Titre</label><br>
        <input type="text" id='title' name='title'><br>

        <label for="content">Titre</label><br>
        <textarea name="content" id="content"></textarea><br>

        <label for="author">Auteur</label><br>
        <input type="text" id="author" name='author'><br>

        <input type="submit" value='Envoyer' id='submit' name="submit">
    </form>
    <a href="../public/index.php">Retour à l'accueil</a>
</div>