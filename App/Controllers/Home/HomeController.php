<?php

namespace App\Controllers\Home;

use App\Template\Page;

class HomeController
{
    public static function index($request, $response, $args)
    {
        $page = new Page();
        $page->setTpl("index");
    }
}
