<?php

namespace App\Src\DAO;

use App\Src\Model\Comment;
use App\Config\Parameter;

class CommentDAO extends DAO
{

    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setCreatedAt($row['createdAt']);
        $comment->setFlag($row['flag']);
        return $comment;
    }

    public function getCommentsFromArticle($articleId)
    {
        $sql = 'SELECT comment.id, comment.content, comment.createdAt, comment.flag, user.pseudo FROM comment INNER JOIN user ON comment.user_id = user.id WHERE article_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$articleId]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function addComment(Parameter $post, $articleId, $userId)
    {
        $sql = 'INSERT INTO comment (content, createdAt,flag, article_id, user_id) VALUES (?, NOW(), 0, ?, ?)';
        $this->createQuery(
            $sql,
            [
                $post->get('content'),
                $articleId,
                $userId
            ]
        );
    }

    public function flagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag = ? WHERE id = ?';
        $this->createQuery($sql, [1, $commentId]);
    }

    public function unflagComment($commentId)
    {
        $sql = 'UPDATE comment SET flag = ? WHERE id = ?';
        $this->createQuery($sql, [0, $commentId]);
    }

    public function deleteComment($commentId)
    {
        $sql = 'DELETE FROM comment WHERE id = ?';
        $this->createQuery($sql, [$commentId]);
    }


    public function getFlagComments()
    {
        $sql = 'SELECT comment.id, comment.content, comment.createdAt, comment.flag, user.pseudo FROM comment INNER JOIN user ON comment.user_id = user.id WHERE flag = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [1]);
        $comments = [];
        foreach ($result as $row) {
            $commentId = $row["id"];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }
}
