<?php


namespace app\controllers;


use app\models\User;

class UserController extends AppController
{
    public function signupAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);

            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                $user_id = $user->save('user');
                if ($user_id) {
                    $_SESSION['success'] = 'Пользователь зарегестрирован';
                    if (!isset($_SESSION['user'])) {
                        $user->login();
                        redirect('/');
                    }
                } else {
                    $_SESSION['error'] = 'Ошибка записи пользователя';
                }
            }
            redirect();
        }
        $this->setMeta('Регистрация');
    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            $user = new User();
            ($user->login()) ? $_SESSION['success'] = 'Вы успешно авторизованы': $_SESSION['error'] = 'Логин/пароль введены неверно';
            redirect();
        }
        $this->setMeta('Вход');
    }

    public function logoutAction()
    {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        redirect();
    }
}