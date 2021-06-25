<?php $this->title = 'Administration' ?>
<?php echo $this->session->show('add_article'); ?>
<?php echo $this->session->show('edit_article'); ?>
<?php echo $this->session->show('delete_article'); ?>

<h2>Articles</h2>
<a href="../public/index.php?route=addArticle">Nouvel article</a>
<table>
    <tr>
        <td>Id</td>
        <td>Titre</td>
        <td>Contenu</td>
        <td>Auteur</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>

    <?php foreach ($articles as $article) { ?>
    <tr>
        <td><?php echo htmlspecialchars($article->getId()) ?></td>
        <td><a href="../public/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()); ?>"><?= htmlspecialchars($article->getTitle()); ?></a></td>
        <td><?php echo substr(htmlspecialchars($article->getContent()), 0, 150) ?></td>
        <td><?php echo htmlspecialchars($article->getAuthor()) ?></td>
        <td>Crée le : <?php echo htmlspecialchars($article->getCreatedAt()) ?></td>
        <td>
            <a href="../public/index.php?route=editArticle&articleId=<?= $article->getId(); ?>">Modifier</a>
            <a href="../public/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>">Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>Commentaires signalés</h2>

<h2>Utilisateurs</h2>