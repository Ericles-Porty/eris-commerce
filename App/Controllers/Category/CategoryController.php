<?php

namespace App\Controllers\Category;

use App\Model\Category;
use App\Template\Page;

class CategoryController
{
    public static function show($request, $response, $args)
    {
        $category = new Category();

        $categoryId = (int)$args['idcategory'];

        $category->get($categoryId);

        $page = new Page();

        $page->setTpl('category', [
            'category' => $category->getValues(),
            'products' => []
        ]);
    }
}
