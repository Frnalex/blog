<?php
$this->title = 'Article';
?>

<div>
    <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
    <p><?= htmlspecialchars($article->getContent()); ?></p>
    <p><?= htmlspecialchars($article->getAuthor()); ?></p>
    <p>Créé le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>
</div>
<br>

<a href="../public/index.php">Retour à l'accueil</a>

<div>
    <h3>Commentaires</h3>

    <?php
    foreach ($comments as $comment) {
    ?>
    <h4><?php echo htmlspecialchars($comment->getPseudo()) ?></h4>
    <p><?php echo htmlspecialchars($comment->getContent()) ?></p>
    <p>Posté le <?php echo htmlspecialchars($comment->getCreatedAt()) ?></p>
    <?php
    }
    ?>
</div>