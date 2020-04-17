<?php

namespace App\src\controller;

class FrontController extends Controller
{

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
