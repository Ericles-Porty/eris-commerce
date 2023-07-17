<?php

use \Hcode\Page;
use \Hcode\Models\Category;

$app->get('/', function () {

	$page = new Page();

	$page->setTpl("index");
});

$app->get('/category/{idcategory}', function ($request, $response, $args) {

	$category = new Category();

	$idcategory = (int)$args['idcategory'];

	$category->get($idcategory);

	$page = new Page();

	$page->setTpl('category', [
		'category' => $category->getValues(),
		'products' => []
	]);
});