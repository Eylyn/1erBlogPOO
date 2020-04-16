<?php
namespace App\src\DAO;
class CommentDAO extends DAO
{
    public function getCommentsFromArticle($articleid)
    {
        $sql = 'SELECT id, pseudo, content, createdAt FROM comment WHERE article_id = ? ORDER BY createdAt DESC';
        return $this->createQuery($sql, [$articleid]);
    }
}
