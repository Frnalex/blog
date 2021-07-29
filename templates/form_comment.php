<?php
$route = isset($post) && $post->get('id') ? 'editComment' : 'addComment';
$submit = $route === "addComment" ? 'Ajouter' : "Mettre à jour";
$pseudo = isset($post) ? htmlspecialchars($post->get('pseudo')) : '';
$content = isset($post) ? htmlspecialchars($post->get('content')) : '';
?>

<form method="POST" action="/index.php?route=<?php echo $route ?>&articleId=<?php echo htmlspecialchars($article->getId()) ?>">

    <label for="content">Message</label><br>
    <textarea name="content" id="content"><?php echo $content ?></textarea><br>
    <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">
    <input type="submit" value="<?php echo $submit ?>" id="submit" name="submit">

</form>