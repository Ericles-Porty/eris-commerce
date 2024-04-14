<?php

namespace App\Controllers\Admin;

use App\Model\User;
use App\Template\PageAdmin;


class AdminController
{
    public static function index($request, $response, $args)
    {
        User::verifyLogin();

        $page = new PageAdmin();

        $page->setTpl("index");
    }

    public static function loginGet($request, $response, $args)
    {
        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);

        $page->setTpl("login");
    }

    public static function loginPost($request, $response, $args)
    {
        User::login($_POST['login'], $_POST['password']);

        header("Location: /admin");
        exit;
    }

    public static function logout($request, $response, $args)
    {
        User::logout();

        header("Location: /admin/login");
        exit;
    }

    public static function forgotGet($request, $response, $args)
    {
        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);

        $page->setTpl("forgot");
    }

    public static function forgotPost($request, $response, $args)
    {
        $user = User::getForgot($_POST['email']);

        header("Location: /admin/forgot/sent");
        exit;
    }

    public static function forgotSent($request, $response, $args)
    {
        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);

        $page->setTpl("forgot-sent");
    }

    public static function forgotResetGet($request, $response, $args)
    {
        $urlCode = urldecode($_GET["code"]);
        $user = User::validForgotDecrypt($urlCode);

        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);

        $page->setTpl("forgot-reset", array(
            "name" => $user["desperson"],
            "code" => $urlCode
        ));
    }

    public static function forgotResetPost($request, $response, $args)
    {
        $forgot = User::validForgotDecrypt($_POST["code"]);

        $user = new User();

        $user->get((int)$forgot["iduser"]);

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT, ["cost" => 12]);

        $user->setPassword($password);

        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);

        $page->setTpl("forgot-reset-success");
    }
}
