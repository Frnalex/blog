<?php
$route = isset($post) && $post->get('id') ? 'editArticle&articleId=' . $post->get('id') : 'addArticle';
$submit = $route === "addArticle" ? 'Envoyer' : "Mettre à jour";
$title = isset($post) ? htmlspecialchars($post->get('title')) : '';
$content = isset($post) ? htmlspecialchars($post->get('content')) : '';
?>

<form method="post" action="/index.php?route=<?php echo $route ?>">

    <label for="title">Titre</label><br>
    <input type="text" id="title" name="title" value="<?php echo $title ?>"><br>
    <?php echo isset($errors['title']) ? $errors['title'] : "" ?>

    <label for="content">Contenu</label><br>
    <textarea id="content" name="content"><?php echo $content ?></textarea><br>
    <?php echo isset($errors['content']) ? $errors['content'] : "" ?>

    <input type="submit" value="<?php echo $submit ?>" id="submit" name="submit">

</form>