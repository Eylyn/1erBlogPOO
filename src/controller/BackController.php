<?php

namespace App\src\controller;

use App\config\Parameter;
class BackController extends Controller
{

    public function addArticle(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors) {
                $this->articleDAO->addArticle($post);
                $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php');
            }

            return $this->view->render('add_article', [
                'post' => $post,
                'errors' => $errors
            ]);
        }

        return $this->view->render('add_article');
    }
    
    public function editArticle(Parameter $post, $articleid)
    {
        $article = $this->articleDAO->getArticle($articleid);
        
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if (!$errors) {
            $this->articleDAO->editArticle($post, $articleid);
            $this->session->set('edit_article', 'L\' article a bien été modifié');
            header('Location: ../public/index.php');
            }
            return $this->view->render('edit_article', [
                'post' => $post,
                'errors' => $errors
            ]);
        }

        $post->set('id', $article->getId());
        $post->set('title', $article->getTitle());
        $post->set('content', $article->getContent());
        $post->set('author', $article->getAuthor());

        return $this->view->render('edit_article', [
            'post' => $post
        ]);
    }
     
    public function deleteArticle($articleid)
    {
        $this->articleDAO->deleteArticle($articleid);
        $this->session->set('delete_article', 'L\'article a bien été supprimé');
        header('Location: ../public/index.php');
    }

}