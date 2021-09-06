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

<a class="text-underline" href="/">Voir le site</a>

<div class="dashboard">

    <!-- Articles -->
    <div class="card">
        <div class="card__header">
            <h2>Articles</h2>
            <a href="/index.php?route=addArticle"><img src="/img/icons/plus.svg" alt=""></a>
        </div>

        <div class="card__body">
            <table>
                <thead>
                    <tr>
                        <td>Titre</td>
                        <td>Auteur</td>
                        <td>Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($articles as $article) {
                        $created_at = utf8_encode(strftime('%d-%m-%Y', strtotime($article->getCreatedAt())))
                    ?>
                    <tr>
                        <td><a href="/index.php?route=article&articleId=<?= htmlspecialchars($article->getId()); ?>"><?= htmlspecialchars($article->getTitle()); ?></a></td>
                        <td nowrap><?php echo htmlspecialchars($article->getAuthor()) ?></td>
                        <td nowrap><?php echo $created_at; ?></td>
                        <td nowrap>
                            <a href="/index.php?route=editArticle&articleId=<?= $article->getId(); ?>&token=<?php echo $this->session->get('token') ?>"><img src="/img/icons/edit.svg" alt="edit"></a>
                            <a href="/index.php?route=deleteArticle&articleId=<?= $article->getId(); ?>&token=<?php echo $this->session->get('token') ?>"><img src="/img/icons/delete.svg" alt="delete"></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Commentaire signalés -->
    <div class="card">
        <div class="card__header">
            <h2>Commentaires signalés</h2>
        </div>

        <div class="card__body">
            <?php if (count($comments) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <td>Message</td>
                        <td>Pseudo</td>
                        <td>Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($comments as $comment) {
                            $created_at = utf8_encode(strftime('%d-%m-%Y', strtotime($article->getCreatedAt())))
                        ?>
                    <tr>
                        <td><?php echo substr(htmlspecialchars($comment->getContent()), 0, 150) ?></td>
                        <td><?php echo htmlspecialchars($comment->getPseudo()) ?></td>
                        <td nowrap><?php echo $created_at; ?></td>
                        <td>
                            <a href="/index.php?route=unflagComment&commentId=<?php echo $comment->getId(); ?>&token=<?php echo $this->session->get('token') ?>"><img src="/img/icons/check.svg" alt="delete"></a><br>
                            <a href="/index.php?route=deleteComment&commentId=<?php echo $comment->getId(); ?>&token=<?php echo $this->session->get('token') ?>"><img src="/img/icons/delete.svg" alt="delete"></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
            <p class="px-3">
                Aucun commentaire n'a été signalé
            </p>
            <?php } ?>
        </div>
    </div>

    <!-- Utilisateurs -->
    <div class="card">
        <div class="card__header">
            <h2>Utilisateurs</h2>
        </div>

        <div class="card__body">
            <table>
                <thead>
                    <tr>
                        <td>Pseudo</td>
                        <td>Rôle</td>
                        <td>Date de création</td>
                        <td>Actions</td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user) {
                        $created_at = utf8_encode(strftime('%d-%m-%Y', strtotime($user->getCreatedAt())))
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->getPseudo()) ?></td>
                        <td nowrap><?php echo htmlspecialchars($user->getRole()) ?></td>
                        <td nowrap><?php echo $created_at; ?></td>
                        <td nowrap>
                            <?php if ($user->getRole() != 'admin') { ?>
                            <a href="/index.php?route=deleteUser&userId=<?php echo $user->getId(); ?>&token=<?php echo $this->session->get('token') ?>"><img src="/img/icons/delete.svg" alt="delete"></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>