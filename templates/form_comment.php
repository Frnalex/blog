<?php
include('set_token.php');

$route = isset($post) && $post->get('id') ? 'editComment' : 'addComment';
$submit = $route === "addComment" ? 'Ajouter' : "Mettre à jour";
$content = isset($post) ? htmlspecialchars($post->get('content')) : '';

?>

<form class="form" method="POST" action="/index.php?route=<?php echo $route ?>&articleId=<?php echo htmlspecialchars($article->getId()) ?>">

    <div class="form-group">
        <textarea name="content" id="content" placeholder="Message"><?php echo $content ?></textarea>
        <?php if (isset($errors['content'])) { ?>
        <p class="text-alert"><?php echo $errors['content'] ?></p>
        <?php } ?>
    </div>

    <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">

    <input class="btn" type="submit" value="<?php echo $submit ?>" id="submit" name="submit">

</form>