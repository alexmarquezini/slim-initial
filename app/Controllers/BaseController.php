<?php 

namespace SlimInitial\Controllers;

class BaseController
{
    protected $view;

    protected $router;

    protected $response;

    protected $request;

    protected $validator;

    protected $auth;

    protected $flash;

    public function __construct($view, $router, $response, $request, $validator, $auth, $flash)
    {
        $this->view = $view;
        $this->router = $router;
        $this->response = $response;
        $this->request = $request;
        $this->validator = $validator;
        $this->auth = $auth;
        $this->flash = $flash;
    }
    
    protected function render($template, $data = [])
    {
        return $this->view->render($this->response, $template, $data);
    }

    protected function redirect($route, $data = [])
    {
        return $this->response->withRedirect($this->router->pathFor($route, $data));
    }

}