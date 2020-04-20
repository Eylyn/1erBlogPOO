<?php

namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Comment;

class CommentDAO extends DAO
{
    private function buildObject($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setCreatedAt($row['createdAt']);
        return $comment;
    }

    public function getCommentsFromArticle($articleid)
    {
        $sql = 'SELECT id, pseudo, content, createdAt FROM comment WHERE article_id = ? ORDER BY createdAt DESC';
        $result = $this->createQuery($sql, [$articleid]);
        $comments = [];
        foreach ($result as $row) {
            $commentid = $row['id'];
            $comments[$commentid] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function addComment(Parameter $post, $articleid)
    {
        $sql = 'INSERT INTO comment (pseudo, content, createdAt, article_id) VALUES(?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('pseudo'), $post->get('content'), $articleid]);
    }
}
