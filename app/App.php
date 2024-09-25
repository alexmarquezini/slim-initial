<?php 

namespace SlimInitial;

use DI\Bridge\Slim\App as DIBridge;
use DI\ContainerBuilder;

class App extends DIBridge
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        $builder->addDefinitions([
            'settings.displayErrorDetails' => true,
            'settings.addContentLengthHeader' => false,
            'settings.determineRouteBeforeAppMiddleware' => true,
        ]);
        $builder->addDefinitions(__DIR__ . '/../bootstrap/container.php');
    }
}