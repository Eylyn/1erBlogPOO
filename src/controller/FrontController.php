<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;

class FrontController
{
    private $articleDAO;
    private $commentDAO;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
    }

    public function home()
    {
        $articles = $this->articleDAO->getArticles();
        require '../templates/home.php';
    }

    public function article($articleid)
    {
        $articles = $this->articleDAO->getArticle($articleid);
        $comments = $this->commentDAO->getCommentsFromArticle($articleid);
        require '../templates/single.php';
    }
}
