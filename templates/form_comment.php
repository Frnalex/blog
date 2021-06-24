<?php
$route = isset($post) && $post->get('id') ? 'editComment' : 'addComment';
$submit = $route === "addComment" ? 'Ajouter' : "Mettre à jour";
$pseudo = isset($post) ? htmlspecialchars($post->get('pseudo')) : '';
$content = isset($post) ? htmlspecialchars($post->get('content')) : '';
?>

<form method="POST" action="../public/index.php?route=<?php echo $route ?>&articleId=<?php echo htmlspecialchars($article->getId()) ?>">

    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value="<?php echo $pseudo ?>">

    <label for="content">Message</label>
    <textarea name="content" id="content"><?php echo $content ?></textarea>

    <input type="submit" value="<?php echo $submit ?>" id="submit" name="submit">

</form>