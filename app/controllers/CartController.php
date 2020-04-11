<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\User;

class CartController extends AppController
{
    public function addAction()
    {
        $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
        $qty = !empty($_GET['qty']) ? (int)$_GET['qty'] : null;
        $modification_id = !empty($_GET['modification']) ? (int)$_GET['modification'] : null;
        $modification = null;

        if (!$id) {
            return false;
        }

        $product = \R::findOne('product', 'id = ?', [$id]);

        if (!$product) {
            return false;
        }
        if ($modification_id) {
            $modification = \R::findOne('modification', 'id = ? AND product_id = ?', [$modification_id, $id]);
        }

        $cart = new Cart();
        $cart->addToCart($product, $qty, $modification);
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function showAction()
    {
        $this->loadView('cart_modal');
    }

    public function deleteAction()
    {
        $id = !empty($_GET['id']) ? $_GET['id'] : null;
        if (isset($_SESSION['cart'][$id])) {
            $cart = new Cart();
            $cart->deleteItem($id);
        }

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction() {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.currency']);
        $this->loadView('cart_modal');
    }

    public function viewAction()
    {
        $this->setMeta('Корзина');
    }

    public function checkoutAction()
    {
        if (!empty($_POST)) {
            //регистрация пользователя
            if (!User::checkAuth()) {
                $user = new User();
                $data = $_POST;
                $user->load($data);

                if (!$user->validate($data) || !$user->checkUnique()) {
                    $user->getErrors();
                    $_SESSION['form_data'] = $data;
                    redirect();
                } else {
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                    $user_id = $user->save('user');
                    if (!$user_id) {
                        $_SESSION['error'] = 'Ошибка записи пользователя';
                        redirect();
                    }
                }
            }
            //сохранение заказа
            $data['user_id'] = $user_id ?? $_SESSION['user']['id'];
            $data['note'] = ($_POST['note']) ?: '';
            $data['currency'] = $_SESSION['cart.currency']['code'];

            $order = new Order();
            $order_id = $order->saveOrder($data);
            $user_email = $_SESSION['user']['email'] ?? $_POST['email'];

            $order->mailOrder($order_id, $user_email);
            if (!$_SESSION['user']) {
                $user = new User();
                $user->login();
            }
        }
        redirect();
    }


}