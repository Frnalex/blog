<?php $this->title = 'Accueil' ?>
<?php echo $this->session->show('flag_comment'); ?>
<?php echo $this->session->show('register'); ?>
<?php echo $this->session->show('logout'); ?>
<?php echo $this->session->show('login'); ?>
<?php echo $this->session->show('delete_account'); ?>
<?php echo $this->session->show('need_token'); ?>

<div class="page-title">
    <h1 class="text-lg">Je. Suis. Alex.</h1>
    <p class="text">Développeur front-end avec un goût prononcé pour la création d’interfaces web & mobile.</p>
    <p class="text">Bienvenue sur mon blog.</p>
</div>



<?php if (count($articles) > 0) { ?>

<div class="articles">
    <p class="text">Articles</p>

    <?php foreach ($articles as $article) {
            setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
            $created_at = utf8_encode(strftime('%d %B %Y', strtotime($article->getCreatedAt())))
        ?>
    <div class="article">
        <h2 class="link article__title"><a href="/index.php?route=article&articleId=<?php echo htmlspecialchars($article->getId()) ?>"><?php echo htmlspecialchars($article->getTitle()); ?></a></h2>
        <p class="text text-capitalize article__date"><?php echo $created_at; ?></p>
    </div>
    <?php } ?>

</div>
<?php } ?>



<div class="page-footer">
    <p class="text">Une question ? <a href="#" class="link">Contactez-moi !</a></p>
</div>