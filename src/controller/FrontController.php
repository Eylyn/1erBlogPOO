<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

class FrontController
{
    private $articleDAO;
    private $commentDAO;
    private $view;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
    }

    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render('home', [
            'articles' => $articles
        ]);
    }

    public function article($articleid)
    {
        $article = $this->articleDAO->getArticle($articleid);
        $comments = $this->commentDAO->getCommentsFromArticle($articleid);
        return $this->view->render('single', [
            'article' => $article,
            'comments' => $comments
        ]);
    }
}
