<?php

namespace App\src\controller;

use App\config\Parameter;
class BackController extends Controller
{

    public function addArticle(Parameter $post)
    {
        if($post->get('submit')) {
            $this->articleDAO->addArticle($post);
            $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
            header('Location: ../public/index.php');
        }

        return $this->view->render('add_article', [
            'post' => $post
        ]);
    }
    
    public function editArticle(Parameter $post, $articleid)
    {
        $article = $this->articleDAO->getArticle($articleid);
        if($post->get('submit')) {
            $this->articleDAO->editArticle($post, $articleid);
            $this->session->set('edit_article', 'L\' article a bien été modifié');
            header('Location: ../public/index.php');
        }
        return $this->view->render('edit_article', [
            'article' => $article
        ]);
    }

}