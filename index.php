<?php

session_start();
require_once("vendor/autoload.php");

use \Slim\App;

$config = ['settings' => [
	'addContentLengthHeader' => false,
]];

$app = new App($config);

// $app->get('/mimir', function () {
// 	exec("shutdown -s -t 0");
// });

require_once("site.php");
require_once("admin.php");
require_once("admin-users.php");
require_once("admin-categories.php");
require_once("admin-products.php");


$app->run();
