<?php


namespace app\controllers\admin;


use app\models\User;
use ishop\libs\Pagination;


class UserController extends AppController
{
    public function indexAction()
    {
       $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
       $perpage = 5;
       $total = \R::count('user');
       $pagination = new Pagination($page, $perpage, $total);
       $start = $pagination->getStart();
       $users = \R::findAll('user', "LIMIT $start, $perpage");
       $this->setMeta('Список пользователей');
       $this->set(compact('users', 'pagination', 'total'));
    }

    public function viewAction()
    {
        $user_id = $this->getRequestId();
        $user = \R::load('user', $user_id);
        $orders = \R::getAll("SELECT 
        `order`.`id`, 
        `order`.`user_id`, 
        `order`.`status`, 
        `order`.`date`, 
        `order`.`update_at`, 
        `order`.`currency`,
        ROUND(SUM(`order_product`.`price`), 2) AS `sum`
        FROM `order` 
        JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
        WHERE `order`.`user_id` = {$user_id}
        GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id`");
        $this->setMeta('Редактирование профиля пользователя');
        $this->set(compact('user', 'orders'));
    }

    public function editAction()
    {
        if (!empty($_POST)) {
            $id = $this->getRequestId(false);
            $user = new \app\models\admin\User();
            $data = $_POST;
            $user->load($data);
            if(!$user->attributes['password']) {
                unset($user->attributes['password']);
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
            }
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                redirect();
            }

            if($user->update('user', $id)) {
                $_SESSION['success'] = 'Изменения сохранены';
                redirect(ADMIN . "/user/view?id=$id");
            }
        }
    }

    public function addAction()
    {
        $this->setMeta('Новый пользователь');
    }

    public function loginAdminAction()
    {
        if (!empty($_POST)) {
            $user = new USer();
            if (!$user->login(true)) {
                $_SESSION['error'] = 'Логин/пароль введены неверно';
            }

            if(User::isAdmin()) {
               redirect(ADMIN);
            } else {
                redirect();
            }
        }
        $this->layout = 'login';
    }
}