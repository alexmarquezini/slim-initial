<?php 

namespace SlimInitial\Middleware;

use Slim\Csrf\Guard;
use Slim\Views\Twig;
use SlimInitial\Support\Auth\Auth;

class Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function view()
    {
        return $this->container->get(Twig::class);
    }

    protected function auth()
    {
        return $this->container->get(Auth::class);
    }

    protected function flash()
    {
        return $this->container->get('flash');
    }

    protected function router()
    {
        return $this->container->get('router');
    }

    protected function guard()
    {
        return $this->container->get(Guard::class);
    }
}