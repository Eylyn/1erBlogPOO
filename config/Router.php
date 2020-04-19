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
        try{
            if(isset($route))
            {
                if($route === 'article'){
                    $this->frontController->article($this->request->getGet()->get('articleid'));
                }
                elseif ($route === 'addArticle'){
                    $this->backController->addArticle($this->request->getPost());
                }
                elseif ($route === 'editArticle'){
                    $this->backController->editArticle($this->request->getPost(), $this->request->getGet()->get('articleid'));
                }
                elseif ($route === "deleteArticle") {
                    $this->backController->deleteArticle($this->request->getGet()->get('articleid'));
                }
                else{
                    $this->errorController->errorNotFound();
                }
            }
            else{
                $this->frontController->home();
            }
        }
        catch (Exception $e)
        {
            $this->errorController->errorServer();
        }
    }
}