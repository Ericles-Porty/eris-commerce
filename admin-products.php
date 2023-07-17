<?php

use \Hcode\PageAdmin;
use \Hcode\Models\User;
use \Hcode\Models\Product;

# Read
$app->get("/admin/products", function () {

    User::verifyLogin();

    $products = Product::listAll();

    $page = new PageAdmin();

    $page->setTpl("products", ['products' => $products]);
});

# Create
$app->get("/admin/products/create", function () {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("products-create");
});

$app->post("/admin/products/create", function () {

    User::verifyLogin();

    $product = new Product();

    $product->setData($_POST);

    $product->save();

    header("Location: /admin/products");
    exit;
});

# Update
$app->get("/admin/products/{idproduct}", function ($request, $response, $args) {

    User::verifyLogin();

    $idproduct = (int)$args['idproduct'];

    $product = new Product();

    $product->get($idproduct);

    $page = new PageAdmin();

    $page->setTpl('products-update', ['product' => $product->getValues()]);
});

$app->post("/admin/products/{idproduct}", function ($request, $response, $args) {

    User::verifyLogin();

    $idproduct = (int)$args['idproduct'];

    $product = new Product();

    $product->get($idproduct);

    $product->setData($_POST);

    if (
        file_exists($_FILES['file']['tmp_name']) ||
        is_uploaded_file($_FILES['file']['tmp_name'])
    ) {
        $product->setPhoto($_FILES["file"]);
    }

    header("Location: /admin/products");
    exit;
});

# Delete
$app->get("/admin/products/{idproduct}/delete", function ($request, $response, $args) {

    User::verifyLogin();

    $idproduct = (int)$args['idproduct'];

    $product = new Product();

    $product->get($idproduct);

    $product->delete();

    header("Location: /admin/products");
    exit;
});
