<?php


namespace app\controllers;


class ProductController extends AppController
{
    public function viewAction()
    {
        $alias = $this->route['alias'];
        $product = \R::findOne('product', "status = '1' AND alias = ?", [$alias]);
        if (!$product) {
            throw new \Exception("Страница product/$alias не найдена", 404);
        }

        //хлебные крошки

        //связанные товары

        //запись в куки просмотренного товара

        //просмотренные товары из куки

        //галерея

        //модификации

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->set(compact('product'));
    }
}