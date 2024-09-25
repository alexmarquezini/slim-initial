<?php

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Headers;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Csrf\Guard;
use Slim\Flash\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig;
use SlimInitial\Support\Auth\Auth;
use SlimInitial\Support\Validation\Contracts\ValidatorInterface;
use SlimInitial\Support\Validation\Validator;

return [

    RouterInterface::class => function(ContainerInterface $container) {
        return new $container->get('router');
    },

    Twig::class => function(ContainerInterface $container) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' => false
        ]);

        $twig->addExtension(new \Slim\Views\TwigExtension(
            $container->get('router'),
            $container->get('request')->getUri()
        ));

        $twig->getEnvironment()->addGlobal('flash', $container->get(Messages::class));

        $twig->getEnvironment()->addGlobal('auth', [
            'check' => $container->get(Auth::class)->check(),
            'user' => $container->get(Auth::class)->user()
        ]);

        return $twig;
    },

    ResponseInterface::class => function(ContainerInterface $container) {
        $headers = new Headers(['Content-Type' => 'text/html; charset=UTF-8']);
        $response = new Response(200, $headers);
        return $response->withProtocolVersion($container->get('settings')['httpVersion']);
    },

    ServerRequestInterface::class => function(ContainerInterface $container) {
        return Request::createFromEnvironment($container->get('environment'));
    },

    ValidatorInterface::class => function (ContainerInterface $container) {
        return new Validator();
    },

    Auth::class => function(ContainerInterface $container) {
        return new Auth();
    },

    Guard::class => function(ContainerInterface $container) {
        return new Guard();
    },

    Messages::class => function(ContainerInterface $container) {
        return new Messages();
    },

];