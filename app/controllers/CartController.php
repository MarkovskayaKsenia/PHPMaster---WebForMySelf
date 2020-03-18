<?php


namespace app\controllers;


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

        exit();
    }

}