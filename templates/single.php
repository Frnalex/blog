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
</article>





<div>
    <h3>Ajouter un commentaire</h3>
    <?php if ($this->session->get('pseudo')) {
        include('form_comment.php');
    } else {
    ?>
    <a href="/index.php?route=register">Inscription</a>
    <a href="/index.php?route=login">Connexion</a>
    <?php } ?>


    <?php if ($comments) { ?>
    <h3>Commentaires</h3>
    <?php foreach ($comments as $comment) { ?>

    <h4><?php echo htmlspecialchars($comment->getPseudo()) ?></h4>
    <p><?php echo htmlspecialchars($comment->getContent()) ?></p>
    <p>Posté le <?php echo htmlspecialchars($comment->getCreatedAt()) ?></p>

    <?php if ($comment->isFlag()) {  ?>
    <p>Ce commentaire a déjà été signalé</p>
    <?php } else { ?>
    <p><a href="/index.php?route=flagComment&commentId=<?php echo $comment->getId() ?>">Signaler le commentaire</a></p>
    <?php } ?>

    <?php if ($this->session->get('role') === 'admin') { ?>
    <p><a href="/index.php?route=deleteComment&commentId=<?php echo $comment->getId() ?>">Supprimer le commentaire</a></p>
    <?php } ?>

    <?php } ?>
    <?php } ?>
</div>

<div class="page-footer">
    <a href="/" class="link">Retour à l'accueil</a>
</div>