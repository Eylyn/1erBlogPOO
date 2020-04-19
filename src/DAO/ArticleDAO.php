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
        $article->setAuthor($row['author']);
        $article->setCreatedAt($row['createdAt']);

        return $article;
    }

    public function getArticles()
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article ORDER BY id DESC';
        $result = $this->createQuery($sql);
        $articles = [];
        foreach($result as $row){
            $articleid = $row['id'];
            $articles[$articleid] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $articles;
    }

    public function getArticle($articleid)
    {
        $sql = 'SELECT id, title, content, author, createdAt FROM article WHERE id=?';
        $result = $this->createQuery($sql, [$articleid]);
        $article = $result->fetch();
        $result->closeCursor();
        return $this->buildObject($article);
    }

    public function addArticle(Parameter $post)
    {
        $sql = 'INSERT INTO article(title, content, author, createdAt) VALUES (?, ?, ?, NOW())';
        $this->createQuery($sql, [$post->get('title'), $post->get('content'), $post->get('author')]);
    }

    public function editArticle(Parameter $post, $articleid)
    {
        $sql = 'UPDATE article SET title=:title, content=:content, author=:author WHERE id=:articleid';
        $this->createQuery($sql, [
            'title' => $post->get('title'),
            'content' => $post->get('content'),
            'author' => $post->get('author'),
            'articleid' => $articleid
        ]);
    }
}