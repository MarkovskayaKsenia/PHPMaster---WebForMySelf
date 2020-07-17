<?php


namespace app\controllers;

use ishop\App;
use ishop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $brands = \R::find('brand', 'LIMIT 3');
        $hits = \R::find('product', "hit = 'hit' AND status = 'active' LIMIT 8");
        $this->setMeta(App::$app->getProperty('shop_name'), 'Описание главной страницы', 'Ключи главной страницы');
        $this->set(compact('brands', 'hits'));
    }
}