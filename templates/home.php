<?php $this->title = 'Accueil' ?>
<?php echo $this->session->show('flag_comment'); ?>
<?php echo $this->session->show('register'); ?>
<?php echo $this->session->show('logout'); ?>
<?php echo $this->session->show('login'); ?>
<?php echo $this->session->show('delete_account'); ?>

<div class="page-title">
    <h1 class="text-lg">Blog</h1>
    <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium molestias.</p>
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