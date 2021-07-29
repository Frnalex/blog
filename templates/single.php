<?php
$this->title = 'Article';

echo $this->session->show('add_comment');
?>

<div>
    <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
    <p><?= htmlspecialchars($article->getContent()); ?></p>
    <p><?= htmlspecialchars($article->getAuthor()); ?></p>
    <p>Créé le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
</div>
<br>

<a href="/index.php">Retour à l'accueil</a>

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