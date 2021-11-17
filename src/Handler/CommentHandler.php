<?php

namespace Alex\Src\Handler;

use Alex\Src\DAO\CommentDAO;

class CommentHandler extends Handler
{
    private $commentDAO;

    public function __construct()
    {
        parent::__construct();
        $this->commentDAO = new CommentDAO();
    }

    public function add($post, $articleId)
    {
        $this->security->checkToken($post->get('token'));
        $errors = $this->validation->validate($post, 'Comment');

        if ($errors) {
            return $errors;
        }

        $this->commentDAO->addComment($post, $articleId, $this->session->get('id'));
        $this->session->set('add_comment', 'Le nouveau commentaire a bien été ajouté');
        header('Location: /index.php?route=article&articleId='.$articleId);
    }

    public function delete($commentId, $token)
    {
        $this->security->checkToken($token);
        $this->commentDAO->deleteComment($commentId);
        $this->session->set('delete_comment', 'Le commentaire a bien été supprimé');
        header('Location: /index.php?route=administration');
    }

    public function flag($commentId, $token)
    {
        $this->security->checkToken($token);
        $this->commentDAO->flagComment($commentId);
        $this->session->set('flag_comment', 'Le commentaire a bien été signalé');
        header('Location: /index.php');
    }

    public function unFlag($commentId, $token)
    {
        $this->security->checkToken($token);
        $this->commentDAO->unflagComment($commentId);
        $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');
        header('Location: /index.php?route=administration');
    }
}
