<?php

namespace App\src\controller;

use App\config\Parameter;
class BackController extends Controller
{

    public function administration()
    {
        $articles = $this->articleDAO->getArticles();
        return $this->view->render('administration', [
            'articles' => $articles
        ]);
    }

    public function addArticle(Parameter $post)
    {
        if($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Article');
            if(!$errors) {
                $this->articleDAO->addArticle($post, $this->session->get('id'));
                $this->session->set('add_article', 'Le nouvel article a bien été ajouté');
                header('Location: ../public/index.php?route=administration');
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
            if(!$errors) {
                $this->articleDAO->editArticle($post, $articleid, $this->session->get('id'));
                $this->session->set('edit_article', 'L\' article a bien été modifié');
                header('Location: ../public/index.php?route=administration');
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
        $this->session->set('delete_article', 'L\'article a bien été supprimé <br>');
        header('Location: ../public/index.php?route=administration');
    }

    public function deleteComment($commentid)
    {
        $this->commentDAO->deleteComment($commentid);
        $this->session->set('delete_comment', 'Le commentaire a bien été supprimé <br>');
        header('Location: ../public/index.php');
    }

    public function profile()
    {
        return $this->view->render('profile');
    }
    
    public function updatePassword(Parameter $post)
    {
        if ($post->get('submit')) {
            $this->userDAO->updatePassword($post, $this->session->get('pseudo'));
            $this->session->set('update_password', 'Mot de passe mis à jour <br>');
            header('Location: ../public/index.php?route=profile');
        }
        return $this->view->render('update_password');
    }

    public function logout()
    {
        $this->logoutOrDelete('logout');
    }

    public function deleteAccount()
    {
        $this->userDAO->deleteAccount($this->session->get('pseudo'));
        $this->logoutOrDelete('delete_account');
    }

    private function logoutOrDelete($param)
    {
        $this->session->stop();
        $this->session->start();
        if($param === 'logout') {
            $this->session->set($param, 'À bientôt');
        } else {
            $this->session->set($param, 'Votre compte a bien été supprimé');
        }
        header('Location: ../public/index.php');
    }
}