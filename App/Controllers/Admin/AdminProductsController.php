<?php

namespace App\Controllers\Admin;

use App\Model\Product;
use App\Model\User;
use App\Template\PageAdmin;

class AdminProductsController
{

    public static function index($request, $response, $args)
    {
        User::verifyLogin();

        $products = Product::listAll();

        $page = new PageAdmin();

        $page->setTpl("products", ['products' => $products]);
    }

    public static function create($request, $response, $args)
    {
        User::verifyLogin();

        $page = new PageAdmin();

        $page->setTpl("products-create");
    }

    public static function store($request, $response, $args)
    {
        User::verifyLogin();

        $product = new Product();

        $product->setData($_POST);

        $product->save();

        header("Location: /admin/products");
        exit;
    }

    public static function show($request, $response, $args)
    {
        User::verifyLogin();

        $idproduct = (int)$args['idproduct'];

        $product = new Product();

        $product->get($idproduct);

        $page = new PageAdmin();

        $page->setTpl('products-update', ['product' => $product->getValues()]);
    }

    public static function edit($request, $response, $args)
    {
        User::verifyLogin();

        $idproduct = (int)$args['idproduct'];

        $product = new Product();

        $product->get($idproduct);

        $page = new PageAdmin();

        $page->setTpl('products-update', ['product' => $product->getValues()]);
    }

    public static function update($request, $response, $args)
    {
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
    }

    public static function destroy($request, $response, $args)
    {
        User::verifyLogin();

        $idproduct = (int)$args['idproduct'];

        $product = new Product();

        $product->get($idproduct);

        $product->delete();

        header("Location: /admin/products");
        exit;
    }
}
