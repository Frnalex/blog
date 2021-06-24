<?php $this->title = 'Accueil' ?>
<?php echo $this->session->show('add_article'); ?>
<?php echo $this->session->show('edit_article'); ?>
<?php echo $this->session->show('delete_article'); ?>
<?php echo $this->session->show('add_comment'); ?>
<?php echo $this->session->show('flag_comment'); ?>
<?php echo $this->session->show('delete_comment'); ?>
<?php echo $this->session->show('register'); ?>

<a href="../public/index.php?route=register">Inscription</a>
<a href="../public/index.php?route=login">Connexion</a>
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