<?php

namespace App\Controllers\Admin;

use App\Model\User;
use App\Template\PageAdmin;

class AdminUsersController
{
    public static function index($request, $response, $args)
    {
        User::verifyLogin();

        $users = User::listAll();

        $page = new PageAdmin();

        $page->setTpl("users", ['users' => $users]);
    }

    public static function create($request, $response, $args)
    {
        User::verifyLogin();

        $page = new PageAdmin();

        $page->setTpl("users-create");
    }

    public static function store($request, $response, $args)
    {
        User::verifyLogin();

        $user = new User();

        $_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, ["cost" => 12]);

        $user->setData($_POST);

        $user->save();

        header("Location: /admin/users");
        exit;
    }

    public static function show($request, $response, $args)
    {
        User::verifyLogin();

        $user = new User();

        $user->get((int) $args['iduser']);

        $page = new PageAdmin();

        $page->setTpl("users-update", [
            "user" => $user->getValues()
        ]);
    }

    public static function edit($request, $response, $args)
    {
        User::verifyLogin();

        $user = new User();

        $user->get((int) $args['iduser']);
    }

    public static function update($request, $response, $args)
    {
        User::verifyLogin();

        $user = new User();

        $user->get((int) $args['iduser']);

        $user->setData($_POST);

        $user->update();

        header("Location: /admin/users");
        exit;
    }

    public static function destroy($request, $response, $args)
    {
        User::verifyLogin();

        $user = new User();

        $user->get((int) $args['iduser']);

        $user->delete();

        header("Location: /admin/users");
        exit;
    }
}
