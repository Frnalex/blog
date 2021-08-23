<?php
$this->title = 'Article';
echo $this->session->show('add_comment');

$title = htmlspecialchars($article->getTitle());
$content = htmlspecialchars($article->getContent());
$author = htmlspecialchars($article->getAuthor());
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
$created_at = utf8_encode(strftime('%d %B %Y', strtotime($article->getCreatedAt())))
?>

<article class="article">
    <header>
        <h2 class="text-md"><?php echo $title ?></h2>
    </header>
    <section>
        <p class="text"><?php echo $content ?></p>
    </section>
    <footer>
        <p>
            Posté le <?php echo $created_at ?> par <?php echo $author ?>.
        </p>
    </footer>

    <!-- Commentaires -->
    <section class="comments">
        <div class="add-new">
            <?php if ($this->session->get('pseudo')) {
                include('form_comment.php');
            } else {
            ?>
            <p>Pour ajouter un nouveau commentaire, vous devez être connecté.</p>
            <a class="text-underline" href="/index.php?route=register">Inscription </a>
            <a class="text-underline" href="/index.php?route=login">Connexion</a>
            <?php } ?>
        </div>


        <?php if ($comments) { ?>
        <h3 class="text-md comments__title">Commentaires</h3>
        <?php foreach ($comments as $comment) {
                $created_at = utf8_encode(strftime('%d %B %Y', strtotime($comment->getCreatedAt())))
            ?>

        <article class="comment">
            <p class="text"><?php echo htmlspecialchars($comment->getContent()) ?></p>
            <p class="comment__date">Posté le <?php echo $created_at ?> par <span class="text-bold"><?php echo htmlspecialchars($comment->getPseudo()) ?></span> </p>

            <?php if ($comment->isFlag()) {  ?>
            <p class="text-alert">Ce commentaire a déjà été signalé</p>
            <?php } else { ?>
            <p class="text-alert"><a href="/index.php?route=flagComment&commentId=<?php echo $comment->getId() ?>&token=<?php echo $this->session->get('token') ?>">Signaler le commentaire</a></p>
            <?php } ?>

            <?php if ($this->session->get('role') === 'admin') { ?>
            <p class="text-alert"><a href="/index.php?route=deleteComment&commentId=<?php echo $comment->getId() ?>&token=<?php echo $this->session->get('token') ?>">Supprimer le commentaire</a></p>

            <?php } ?>

        </article>


        <?php } ?>
        <?php } ?>
    </section>
</article>







<div class="page-footer">
    <a href="/" class="link">Retour à l'accueil</a>
</div>