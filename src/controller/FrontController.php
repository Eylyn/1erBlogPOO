<?php

namespace App\src\controller;

use App\config\Parameter;

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
    public function addComment(Parameter $post, $articleid)
    {
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'Comment');
            if (!$errors) {
                $this->commentDAO->addComment($post, $articleid);
                $this->session->set('addComment', 'Votre commentaire a bien été ajouté <br>');
                header('Location: ../public/index.php?route=article&articleid=' . $articleid);
            }
            $article = $this->articleDAO->getArticle($articleid);
            $comments = $this->commentDAO->getCommentsFromArticle(($articleid));
            return $this->view->render('single', [
                'article' => $article,
                'comments' => $comments,
                'post' => $post,
                'errors' => $errors
            ]);
        }
    }

    public function flagComment($commentid)
    {
        $this->commentDAO->flagComment($commentid);
        $this->session->set('flag_comment', 'Le commentaire a bien été signalé <br>');
        header('Location: ../public/index.php');
    }

    public function register(Parameter $post)
    {
        if ($post->get('submit')) {
            $errors = $this->validation->validate($post, 'User');
            if ($this->userDAO->checkUser($post)) {
                $errors['pseudo'] = $this->userDAO->checkUser($post);
            }
            if (!$errors) {
                $this->userDAO->register($post);
                $this->session->set('register', 'Votre inscription a bien été effectuée <br>');
                header('Location: ../public/index.php');
            }
            return $this->view->render('register', [
                'post' => $post,
                'errors' => $errors
            ]);
        }
        return $this->view->render('register');
    }

    public function login(Parameter $post)
    {
        if ($post->get('submit')) {
            $result = $this->userDAO->login($post);
            if ($result && $result['isPasswordValid']) {
                $this->session->set('login', 'Content de vous revoir <br>');
                $this->session->set('id', $result['result']['id']);
                $this->session->set('role', $result['result']['name']);
                $this->session->set('pseudo', $post->get('pseudo'));
                header('Location: ../public/index.php');
            }
            else {
                $this->session->set('error_login', 'Le pseudo ou le mot de passe sont incorrects');
                return $this->view->render('login', [
                    'post' => $post
                ]);
            }
        }
        return $this->view->render('login');
    }
}
