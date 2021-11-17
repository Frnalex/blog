<?php

namespace Alex\Src\Controller;

use Alex\Config\Parameter;
use Alex\Src\Handler\CommentHandler;

class CommentController extends Controller
{
    private $commentHandler;

    public function __construct()
    {
        parent::__construct();
        $this->commentHandler = new CommentHandler();
    }

    public function addComment(Parameter $post, $articleId)
    {
        $this->checkLoggedIn();

        if ($post->get('submit')) {
            $this->checkToken($post->get('token'));
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
        $this->checkAdmin();
        $this->checkToken($token);
        $this->commentHandler->delete($commentId);
    }

    public function flagComment($commentId, $token)
    {
        $this->checkToken($token);
        $this->commentHandler->flag($commentId);
    }

    public function unflagComment($commentId, $token)
    {
        $this->checkAdmin();
        $this->checkToken($token);
        $this->commentHandler->unFlag($commentId);
    }
}
