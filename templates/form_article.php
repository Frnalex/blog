<?php
$route = isset($article) && $article->getId() ? 'editArticle&articleId=' . $article->getId() : 'addArticle';
$submit = $route === "addArticle" ? 'Envoyer' : "Mettre à jour";
$title = isset($article) && $article->getId() ? htmlspecialchars($article->getTitle()) : "";
$content = isset($article) && $article->getId() ? htmlspecialchars($article->getContent()) : "";
$author = isset($article) && $article->getId() ? htmlspecialchars($article->getAuthor()) : "";
?>

<form method="post" action="../public/index.php?route=<?php echo $route ?>">
    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?php echo $title ?>"><br>
    <label for="content">Contenu</label><br>
    <textarea id="content" name="content"><?php echo $content ?></textarea><br>
    <label for="author">Auteur</label><br>
    <input type="text" id="author" name="author" value="<?php echo $author ?>"><br>
    <input type="submit" value="<?php echo $submit ?>" id="submit" name="submit">
</form>