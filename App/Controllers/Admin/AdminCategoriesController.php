<?php

namespace App\Controllers\Admin;

use App\Model\Category;
use App\Model\User;
use App\Template\PageAdmin;

class AdminCategoriesController
{
    public static function index($request, $response, $args)
    {
        User::verifyLogin();

        $categories = Category::listAll();

        $page = new PageAdmin();

        $page->setTpl("categories", ['categories' => $categories]);
    }

    public static function create($request, $response, $args)
    {
        User::verifyLogin();

        $page = new PageAdmin();

        $page->setTpl("categories-create");
    }

    public static function store($request, $response, $args)
    {
        User::verifyLogin();

        $category = new Category();

        $category->setData($_POST);

        $category->save();

        header("Location: /admin/categories");
        exit;
    }



    public static function show($request, $response, $args)
    {
        User::verifyLogin();

        $category = new Category();

        $idcategory = (int)$args['idcategory'];

        $category->get($idcategory);

        $page = new PageAdmin();

        $page->setTpl("categories-update", [
            'category' => $category->getValues()
        ]);
    }

    public static function edit($request, $response, $args)
    {
        User::verifyLogin();

        $category = new Category();

        $idcategory = (int)$args['idcategory'];

        $category->get($idcategory);

        $page = new PageAdmin();

        $page->setTpl("categories-update", [
            'category' => $category->getValues()
        ]);
    }

    public static function update($request, $response, $args)
    {
        User::verifyLogin();

        $category = new Category();

        $idCategory = (int)$args['idcategory'];

        $category->get($idCategory);

        $category->setData($_POST);

        $category->save();

        header("Location: /admin/categories");
        exit;
    }

    public static function destroy($request, $response, $args)
    {
        User::verifyLogin();

        $category = new Category();

        $idcategory = (int)$args['idcategory'];

        $category->get($idcategory);

        $category->delete();

        header("Location: /admin/categories");
        exit;
    }
}
