<?php

namespace App\src\controller;

use App\config\Parameter;

class BackController extends Controller
{

    private function checkLoggedIn()
    {
        if (!$this->session->get('pseudo')) {
            $this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
            header('Location: ../public/index.php?route=login');
        } else {
            return true;
        }
    }

    private function checkAdmin()
    {
        $this->checkLoggedIn();
        if (!($this->session->get('role') === 'admin')) {
            $this->session->set('not_admin', 'Vous n\'avez pas le droit d\'accéder à cette page');
            header('Location: ../public/index.php?route=profile');
        } else {
            return true;
        }
    }

    public function administration()
    {
        if ($this->checkAdmin()) {
            $articles = $this->articleDAO->getArticles();
            $comments = $this->commentDAO->getFlagComments();
            $users = $this->userDAO->getUsers();

            return $this->view->render('administration', [
                'articles' => $articles,
                'comments' => $comments,
                'users' => $users
            ]);
        }
    }

    public function addArticle(Parameter $post)
    {
        if ($this->checkAdmin()) {
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
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
    }

    public function editArticle(Parameter $post, $articleid)
    {
        if ($this->checkAdmin()) {
            $article = $this->articleDAO->getArticle($articleid);
            if ($post->get('submit')) {
                $errors = $this->validation->validate($post, 'Article');
                if (!$errors) {
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
    }

    public function deleteArticle($articleid)
    {
        if ($this->checkAdmin()) {
            $this->articleDAO->deleteArticle($articleid);
            $this->session->set('delete_article', 'L\'article a bien été supprimé <br>');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function unflagComment($commentid)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->unflagComment($commentid);
            $this->session->set('unflag_comment', 'Le commentaire a bien été désignalé');
            header('Location: ../public/index.php?route=administration');
        }
    }

    public function deleteComment($commentid)
    {
        if ($this->checkAdmin()) {
            $this->commentDAO->deleteComment($commentid);
            $this->session->set('delete_comment', 'Le commentaire a bien été supprimé <br>');
            header('Location: ../public/index.php?route=administration');
        }
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
        if ($this->checkLoggedIn()) {
            $this->logoutOrDelete('logout');
        }
    }

    public function deleteAccount()
    {
        if ($this->checkLoggedIn()) {
            $this->userDAO->deleteAccount($this->session->get('pseudo'));
            $this->logoutOrDelete('delete_account');
        }
    }

    public function deleteUser($userid)
    {
        if ($this->checkAdmin()) {
            $this->userDAO->deleteUser($userid);
            $this->session->set('delete_user', 'L\utilisateur a bien été supprimé');
            header('Location: ../public/index.php?route=administration');
        }
    }
    private function logoutOrDelete($param)
    {
        $this->session->stop();
        $this->session->start();
        if ($param === 'logout') {
            $this->session->set($param, 'À bientôt');
        } else {
            $this->session->set($param, 'Votre compte a bien été supprimé');
        }
        header('Location: ../public/index.php');
    }
}
