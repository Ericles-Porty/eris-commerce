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

$app->get('/mimir', function () {
	exec("shutdown -s -t 0");
});

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

$app->get('/admin/users', function () {

	User::verifyLogin();

	$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users", array("users" => $users));
});

$app->get('/admin/users/create', function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-create");
});

$app->get('/admin/users/{iduser}/delete', function ($request, $response, $args) {

	User::verifyLogin();

	$user = new User();

	$user->get((int) $args['iduser']);

	$user->delete();

	header("Location: /admin/users");
	exit;
});

$app->get('/admin/users/{iduser}', function ($request, $response, $args) {


	User::verifyLogin();

	$user = new User();

	$user->get((int) $args['iduser']);

	$page = new PageAdmin();

	$page->setTpl("users-update", array(
		"user" => $user->getValues()
	));
});

$app->post('/admin/users/create', function () {

	User::verifyLogin();

	$user = new User();

	$user->setData($_POST);

	$user->save();

	header("Location: /admin/users");
	exit;
});

$app->post('/admin/users/{iduser}', function ($request, $response, $args) {

	User::verifyLogin();

	$user = new User();

	$user->get((int) $args['iduser']);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
	exit;
});



$app->run();
