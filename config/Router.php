<?php

namespace App\config;

use App\src\controller\BackController;
use App\src\controller\ErrorController;
use App\src\controller\FrontController;
use Exception;

class Router
{
    private $frontController;
    private $backController;
    private $errorController;
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->frontController = new FrontController();
        $this->backController = new BackController();
        $this->errorController = new ErrorController();
    }

    public function run()
    {
        $route = $this->request->getGet()->get('route');
        try {
            if (isset($route)) {
                if ($route === 'article') {
                    $this->frontController->article($this->request->getGet()->get('articleid'));
                } elseif ($route === 'addArticle') {
                    $this->backController->addArticle($this->request->getPost());
                } elseif ($route === 'register') {
                    $this->frontController->register($this->request->getPost());
                } elseif ($route === 'login') {
                    $this->frontController->login($this->request->getPost());
                } elseif ($route === 'profile') {
                    $this->backController->profile();
                } elseif ($route === 'administration') {
                    $this->backController->administration();
                } elseif ($route === 'logout') {
                    $this->backController->logout();
                } elseif ($route === 'updatePassword') {
                    $this->backController->updatePassword($this->request->getPost());
                } elseif ($route === 'editArticle') {
                    $this->backController->editArticle($this->request->getPost(), $this->request->getGet()->get('articleid'));
                } elseif ($route === "deleteArticle") {
                    $this->backController->deleteArticle($this->request->getGet()->get('articleid'));
                } elseif ($route === 'addComment') {
                    $this->frontController->addComment($this->request->getPost(), $this->request->getGet()->get('articleid'));
                } elseif ($route === 'flagComment') {
                    $this->frontController->flagComment($this->request->getGet()->get('commentid'));
                } elseif ($route === 'unflagComment') {
                    $this->backController->unflagComment($this->request->getGet()->get('commentId'));
                } elseif ($route === 'deleteComment') {
                    $this->backController->deleteComment($this->request->getGet()->get('commentid'));
                } elseif ($route === 'deleteAccount') {
                    $this->backController->deleteAccount();
                } elseif ($route === 'deleteUser') {
                    $this->backController->deleteUser($this->request->getGet()->get('userId'));
                } else {
                    $this->errorController->errorNotFound();
                }
            } else {
                $this->frontController->home();
            }
        } catch (Exception $e) {
            $this->errorController->errorServer();
        }
    }
}
