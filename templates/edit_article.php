<?php $this->title = 'Modifier article' ?>

<div>
    <form method="POST" action="../public/index.php?route=editArticle&articleId=<?php echo htmlspecialchars($article->getId()) ?>">

        <label for="title">Titre</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article->getTitle()) ?>"><br>

        <label for="content">Contenu</label><br>
        <textarea name="content" id="content"><?php echo htmlspecialchars($article->getContent()) ?></textarea><br>

        <label for="author">Auteur</label><br>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($article->getAuthor()) ?>"><br>

        <input type="submit" value="Mettre à jour" id="submit" name="submit">
    </form>

    <a href="../public/index.php">Retour à l'accueil</a>
</div>