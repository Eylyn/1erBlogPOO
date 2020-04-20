<?php
namespace App\src\DAO;

use App\config\Parameter;
use App\src\model\Article;
class ArticleDAO extends DAO
{
    private function buildObject($row)
    {
        $article = new Article();
        $article->setId($row['id']);
        $article->setTitle($row['title']);
        $article->setContent($row['content']);
        $article->setAuthor($row['pseudo']);
        $article->setCreatedAt($row['createdAt']);

        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id ORDER BY article.id DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach ($result as $row){
            $articleid = $row['id'];
            $articles[$articleid] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    public function getArticle($articleid)
    {
        $sql = 'SELECT article.id, article.title, article.content, user.pseudo, article.createdAt FROM article INNER JOIN user ON article.user_id = user.id WHERE article.id = ?';
        $result = $this->createQuery($sql, [$articleid]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }

    public function addArticle(Parameter $post, $userid)
    {
        $sql = 'INSERT INTO article (title, content, createdAt, user_id) VALUES (?, ?, NOW(), ?)';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $userid]);
    }

    public function editArticle(Parameter $post, $articleid, $userid)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, user_id=:user_id WHERE id=:articleid';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'user_id' => $userid,
            'articleid' => $articleid
        ]);
    }

    public function deleteArticle($articleid)
    {
        $sql = 'DELETE FROM comment WHERE article_id = ?';
        $this->createQuery($sql, [$articleid]);
        $sql = 'DELETE FROM article WHERE id = ?';
        $this->createQuery($sql, [$articleid]);
        
    }
}