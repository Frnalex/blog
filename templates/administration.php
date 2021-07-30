<?php
include('set_token.php');
$this->title = 'Administration';
echo $this->session->show('add_article');
echo $this->session->show('edit_article');
echo $this->session->show('delete_article');
echo $this->session->show('unflag_comment');
echo $this->session->show('delete_comment');
echo $this->session->show('delete_user');
?>

<h2>Articles</h2>
<a href="/index.php?route=addArticle">Nouvel article</a>
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
        <td><a href="/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()); ?>"><?= htmlspecialchars($article->getTitle()); ?></a></td>
        <td><?php echo substr(htmlspecialchars($article->getContent()), 0, 150) ?></td>
        <td><?php echo htmlspecialchars($article->getAuthor()) ?></td>
        <td>Crée le : <?php echo htmlspecialchars($article->getCreatedAt()) ?></td>
        <td>
            <a href="/index.php?route=editArticle&articleId=<?= $article->getId(); ?>&token=<?php echo $this->session->get('token') ?>">Modifier</a>
            <a href="/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>&token=<?php echo $this->session->get('token') ?>">Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>Commentaires signalés</h2>
<table>
    <tr>
        <td>Id</td>
        <td>Pseudo</td>
        <td>Message</td>
        <td>Date</td>
        <td>Actions</td>
    </tr>


    <?php foreach ($comments as $comment) { ?>
    <tr>
        <td><?php echo htmlspecialchars($comment->getId()) ?></td>
        <td><?php echo htmlspecialchars($comment->getPseudo()) ?></td>
        <td><?php echo substr(htmlspecialchars($comment->getContent()), 0, 150) ?></td>
        <td>Crée le : <?php echo htmlspecialchars($comment->getCreatedAt()) ?></td>
        <td>
            <a href="/index.php?route=unflagComment&commentId=<?php echo $comment->getId(); ?>&token=<?php echo $this->session->get('token') ?>">Désignaler le commentaire</a><br>
            <a href="/index.php?route=deleteComment&commentId=<?php echo $comment->getId(); ?>&token=<?php echo $this->session->get('token') ?>">Supprimer le commentaire</a>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>Utilisateurs</h2>
<table>
    <tr>
        <td>Id</td>
        <td>Pseudo</td>
        <td>Date</td>
        <td>Rôle</td>
        <td>Actions</td>
    </tr>


    <?php foreach ($users as $user) { ?>
    <tr>
        <td><?php echo htmlspecialchars($user->getId()) ?></td>
        <td><?php echo htmlspecialchars($user->getPseudo()) ?></td>
        <td>Crée le : <?php echo htmlspecialchars($user->getCreatedAt()) ?></td>
        <td><?php echo htmlspecialchars($user->getRole()) ?></td>
        <td>
            <?php if ($user->getRole() != 'admin') { ?>
            <a href="/index.php?route=deleteUser&userId=<?php echo $user->getId(); ?>&token=<?php echo $this->session->get('token') ?>">Supprimer</a>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>