<?php

use \Hcode\PageAdmin;
use \Hcode\Models\User;

$app->get('/admin/users', function () {

    User::verifyLogin();

    $users = User::listAll();

    $page = new PageAdmin();

    $page->setTpl("users", array("users" => $users));
});

$app->get('/admin/users/create', function () {

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("users-create");
});

$app->get('/admin/users/{iduser}/delete', function ($request, $response, $args) {

    User::verifyLogin();

    $user = new User();

    $user->get((int) $args['iduser']);

    $user->delete();

    header("Location: /admin/users");
    exit;
});

$app->get('/admin/users/{iduser}', function ($request, $response, $args) {


    User::verifyLogin();

    $user = new User();

    $user->get((int) $args['iduser']);

    $page = new PageAdmin();

    $page->setTpl("users-update", array(
        "user" => $user->getValues()
    ));
});

$app->post('/admin/users/create', function () {

    User::verifyLogin();

    $user = new User();

    $_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, ["cost" => 12]);

    $user->setData($_POST);

    $user->save();

    header("Location: /admin/users");
    exit;
});

$app->post('/admin/users/{iduser}', function ($request, $response, $args) {

    User::verifyLogin();

    $user = new User();

    $user->get((int) $args['iduser']);

    $user->setData($_POST);

    $user->update();

    header("Location: /admin/users");
    exit;
});
