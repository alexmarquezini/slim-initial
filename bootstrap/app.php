<?php

use Noodlehaus\Config;
use Respect\Validation\Validator;
use SlimInitial\App;
use SlimInitial\Middleware\CsrfViewMiddleware;
use SlimInitial\Middleware\OldInputMiddleware;
use SlimInitial\Middleware\ValidationErrorsMiddleware;

session_start();

require __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__ . '\/..\/');
$dotenv->load();

$app = new App();

$container = $app->getContainer();
$config = new Config(__DIR__ . '/../config/database.php');
$db = $config->get('db');

$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($db);
$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../app/routes/web.php';
require __DIR__ . '/../app/routes/api.php';

$app->add(new ValidationErrorsMiddleware($container));
$app->add(new OldInputMiddleware($container));
$app->add(new CsrfViewMiddleware($container));

Validator::with('SlimInitial\\Validation\\Rules\\');