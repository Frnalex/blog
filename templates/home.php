<?php $this->title = 'Accueil' ?>
<?php echo $this->session->show('add_article') ?>

<a href="../public/index.php?route=addArticle">Nouvel article</a>

<?php
foreach ($articles as $article) {
?>

<div>
    <h2><a href="../public/index.php?route=article&articleId=<?php echo htmlspecialchars($article->getId()) ?>"><?php echo htmlspecialchars($article->getTitle()); ?></a></h2>
    <p><?php echo htmlspecialchars($article->getContent()); ?></p>
    <p><?php echo htmlspecialchars($article->getAuthor()); ?></p>
    <p>Créé le : <?php echo htmlspecialchars($article->getCreatedAt()); ?></p>
</div>
<br>

<?php
}