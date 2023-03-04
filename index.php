<?php

session_start();
require_once("vendor/autoload.php");

use \Slim\App;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Models\User;

require_once("vendor/autoload.php");

$config = ['settings' => [
	'addContentLengthHeader' => false,
]];

$app = new App($config);

$app->get('/', function () {

	$page = new Page();

	$page->setTpl("index");
});

$app->get('/admin', function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");
});

$app->get('/admin/login', function () {

	$page = new PageAdmin([
		"header" => false,
		"footer" => false
	]);

	$page->setTpl("login");
});

$app->post('/admin/login', function () {
	User::login($_POST['login'], $_POST['password']);

	header("Location: /admin");
	exit;
});


$app->get('/admin/logout', function () {

	User::logout();

	header("Location: /admin/login");
	exit;
});

$app->run();
