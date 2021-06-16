<?php
require '../vendor/autoload.php';

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Mon blog</h1>

    <?php
    $article = new ArticleDAO();
    $articles = $article->getArticle($_GET['articleId']);
    $article = $articles->fetch()

    ?>
    <div>
        <h2><?= htmlspecialchars($article->title); ?></h2>
        <p><?= htmlspecialchars($article->content); ?></p>
        <p><?= htmlspecialchars($article->author); ?></p>
        <p>Créé le : <?= htmlspecialchars($article->createdAt); ?></p>
    </div>
    <br>
    <?php
    $articles->closeCursor();
    ?>

    <a href="home.php">Retour à l'accueil</a>

    <div>
        <h3>Commentaires</h3>

        <?php
        $comment = new CommentDAO();
        $comments = $comment->getCommentsFromArticle($_GET['articleId']);
        while ($comment = $comments->fetch()) {
        ?>
        <h4><?php echo htmlspecialchars($comment->pseudo) ?></h4>
        <p><?php echo htmlspecialchars($comment->content) ?></p>
        <p>Posté le <?php echo htmlspecialchars($comment->createdAt) ?></p>
        <?php
        }
        $comments->closeCursor();
        ?>
    </div>

</body>

</html>