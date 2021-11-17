<?php

namespace Alex\Src\Controller;

use Alex\Config\Parameter;
use Alex\Src\DAO\ArticleDAO;
use Alex\Src\DAO\CommentDAO;
use Alex\Src\Handler\CommentHandler;

class CommentController extends Controller
{
    private $commentHandler;
    private $articleDAO;
    private $commentDAO;

    public function __construct()
    {
        parent::__construct();
        $this->commentHandler = new CommentHandler();
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
    }

    public function addComment(Parameter $post, $articleId)
    {
        $this->security->checkLoggedIn();

        if ($post->get('submit')) {
            $errors = $this->commentHandler->add($post, $articleId);

            $article = $this->articleDAO->getArticle($articleId);
            $comments = $this->commentDAO->getCommentsFromArticle($articleId);

            return $this->render(
                'single',
                [
                    'article' => $article,
                    'comments' => $comments,
                    'post' => $post,
                    'errors' => $errors,
                ]
            );
        }
    }

    public function deleteComment($commentId, $token)
    {
        $this->security->checkAdmin();
        $this->commentHandler->delete($commentId, $token);
    }

    public function flagComment($commentId, $token)
    {
        $this->commentHandler->flag($commentId, $token);
    }

    public function unflagComment($commentId, $token)
    {
        $this->security->checkAdmin();
        $this->commentHandler->unFlag($commentId, $token);
    }
}
