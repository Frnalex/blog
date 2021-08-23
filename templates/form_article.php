<?php
include('set_token.php');

$route = isset($post) && $post->get('id') ? 'editArticle&articleId=' . $post->get('id') : 'addArticle';
$value = $route === "addArticle" ? 'Ajouter un article' : "Mettre à jour l'article";
$title = isset($post) ? htmlspecialchars($post->get('title')) : '';
$content = isset($post) ? htmlspecialchars($post->get('content')) : '';
?>

<a class="text-underline" href="/index.php?route=administration">Retour à l'administration</a>

<div class="dashboard">
    <div class="card">

        <div class="card__header">
            <h2><?php echo $value ?></h2>
        </div>

        <div class="card__body">

            <form method="POST" action="/index.php?route=<?php echo $route ?>" class="form">

                <div class="form-group">
                    <input type="text" placeholder="Titre" id="title" name="title" value="<?php echo $title ?>">
                    <?php if (isset($errors['title'])) { ?>
                    <p class="text-alert"><?php echo $errors['title'] ?></p>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <textarea name="content" id="content" placeholder="Contenu"><?php echo $content ?></textarea>
                    <?php if (isset($errors['content'])) { ?>
                    <p class="text-alert"><?php echo $errors['content'] ?></p>
                    <?php } ?>
                </div>

                <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">

                <input class="btn" type="submit" value="<?php echo $value ?>" id="submit" name="submit">

            </form>

        </div>

    </div>
</div>