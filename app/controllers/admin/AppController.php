<?php


namespace app\controllers\admin;


use app\models\AppModel;
use app\models\User;
use ishop\base\Controller;

class AppController extends Controller
{
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);

        if (!User::isAdmin() && $route['action'] !== 'login-admin') {
            redirect(ADMIN . '/user/login-admin');
        }
        new AppModel();
    }

    public function getRequestId($get = true, $id = 'id')
    {
       $data = ($get) ? $_GET : $_POST;
       $id = (!empty($data[$id])) ? (int) $data[$id] : null;

       if (!$id) {
           throw new \Exception('Страница не найдена', 404);
       }

       return $id;
    }
}