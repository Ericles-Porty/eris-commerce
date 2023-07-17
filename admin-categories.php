<?php 

use \Hcode\PageAdmin;
use \Hcode\Models\User;
use \Hcode\Models\Category;

$app->get("/admin/categories", function () {

	User::verifyLogin();

	$categories = Category::listAll();

	$page = new PageAdmin();

	$page->setTpl("categories", ['categories' => $categories]);
});

$app->get("/admin/categories/create", function () {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("categories-create");
});

$app->post("/admin/categories/create", function () {

	User::verifyLogin();

	$category = new Category();

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");
	exit;
});

$app->get("/admin/categories/{idcategory}/delete", function ($request, $response, $args) {

	User::verifyLogin();

	$category = new Category();

	$idcategory = (int)$args['idcategory'];

	$category->get($idcategory);

	$category->delete();

	header("Location: /admin/categories");
	exit;
});

$app->get("/admin/categories/{idcategory}", function ($request, $response, $args) {

	User::verifyLogin();

	$category = new Category();

	$idcategory = (int)$args['idcategory'];

	$category->get($idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update", ['category' => $category->getValues()]);
});

$app->post("/admin/categories/{idcategory}", function ($request, $response, $args) {

	User::verifyLogin();

	$category = new Category();

	$idcategory = (int)$args['idcategory'];

	$category->get($idcategory);

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");
	exit;
});