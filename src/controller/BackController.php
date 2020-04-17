<?php

namespace App\src\controller;

class BackController extends Controller
{

    public function addArticle($post)
    {
        if(isset($post['submit'])) {
            $this->articleDAO->addArticle($post);
            header('Location: ../public/index.php');
        }

        return $this->view->render('add_article', [
            'post' => $post
        ]);
    }

}