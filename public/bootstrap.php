<?php

session_start();

use App\Routes\Routes;
use \Slim\App;

$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new App($config);

$app = Routes::loadRoutes($app);

$app->run();
