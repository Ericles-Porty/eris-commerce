<?php

namespace App\Routes;

use App\Controllers\Admin\AdminCategoriesController;
use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\AdminProductsController;
use App\Controllers\Admin\AdminUsersController;
use App\Controllers\Category\CategoryController;
use App\Controllers\Home\HomeController;
use Slim\App;

class Routes
{
    public static function loadRoutes(App $app): App
    {
        $app->get('/', [HomeController::class, 'index']);

        $app->group('/category', function (App $app) {
            $app->get('/{id}', [CategoryController::class, 'show']);
        });

        $app->group('/admin', function (App $app) {
            $app->get('', [AdminController::class, 'index']);

            $app->group('/users', function (App $app) {
                $app->get('', [AdminUsersController::class, 'index']);
                $app->get('/create', [AdminUsersController::class, 'create']);
                $app->get('/{id}', [AdminUsersController::class, 'show']);
                $app->post('', [AdminUsersController::class, 'store']);
                $app->put('/{id}', [AdminUsersController::class, 'update']);
                $app->delete('/{id}', [AdminUsersController::class, 'destroy']);
            });

            $app->group('/categories', function (App $app) {
                $app->get('', [AdminCategoriesController::class, 'index']);
                $app->get('/create', [AdminCategoriesController::class, 'create']);
                $app->get('/{id}', [AdminCategoriesController::class, 'category']);
                $app->post('', [AdminCategoriesController::class, 'store']);
                $app->put('/{id}', [AdminCategoriesController::class, 'update']);
                $app->delete('/{id}', [AdminCategoriesController::class, 'destroy']);
            });

            $app->group('/products', function (App $app) {
                $app->get('', [AdminProductsController::class, 'index']);
                $app->get('/create', [AdminProductsController::class, 'create']);
                $app->get('/{id}', [AdminProductsController::class, 'category']);
                $app->post('', [AdminProductsController::class, 'store']);
                $app->put('/{id}', [AdminProductsController::class, 'update']);
                $app->delete('/{id}', [AdminProductsController::class, 'destroy']);
            });
        });

        return $app;
    }
}
