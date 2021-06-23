<?php
$route = isset($article) && $article->getId() ? 'editArticle&articleId=' . $article->getId() : 'addArticle';
$submit = $route === "addArticle" ? 'Envoyer' : "Mettre à jour";
$title = isset($post) ? htmlspecialchars($post->get('title')) : '';
$content = isset($post) ? htmlspecialchars($post->get('content')) : '';
$author = isset($post) ? htmlspecialchars($post->get('author')) : '';
?>

<form method="post" action="../public/index.php?route=<?php echo $route ?>">

    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?php echo $title ?>"><br>
    <?php echo isset($errors['title']) ? $errors['title'] : "" ?>

    <label for="content">Contenu</label><br>
    <textarea id="content" name="content"><?php echo $content ?></textarea><br>
    <?php echo isset($errors['content']) ? $errors['content'] : "" ?>

    <label for="author">Auteur</label><br>
    <input type="text" id="author" name="author" value="<?php echo $author ?>"><br>
    <?php echo isset($errors['author']) ? $errors['author'] : "" ?>

    <input type="submit" value="<?php echo $submit ?>" id="submit" name="submit">

</form>