<?php $this->title = 'Accueil' ?>
<?php echo $this->session->show('flag_comment'); ?>
<?php echo $this->session->show('register'); ?>
<?php echo $this->session->show('logout'); ?>
<?php echo $this->session->show('login'); ?>
<?php echo $this->session->show('delete_account'); ?>
<?php echo $this->session->show('need_token'); ?>

<?php if ($this->session->get('pseudo')) { ?>
<a href="/index.php?route=logout">Déconnexion</a>
<a href="/index.php?route=profile">Profil</a>
<?php if ($this->session->get('role') === 'admin') { ?>
<a href="/index.php?route=administration">Administration</a>
<?php } ?>
<?php } else { ?>
<a href="/index.php?route=register">Inscription</a>
<a href="/index.php?route=login">Connexion</a>
<?php } ?>

<?php
foreach ($articles as $article) {
?>

<div>
    <h2><a href="/index.php?route=article&articleId=<?php echo htmlspecialchars($article->getId()) ?>"><?php echo htmlspecialchars($article->getTitle()); ?></a></h2>
    <p><?php echo htmlspecialchars($article->getContent()); ?></p>
    <p><?php echo htmlspecialchars($article->getAuthor()); ?></p>
    <p>Créé le : <?php echo htmlspecialchars($article->getCreatedAt()); ?></p>
</div>
<br>

<?php
}