<?php


namespace app\controllers;

use ishop\App;
use ishop\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $this->setMeta(App::$app->getProperty('shop_name'), 'Описание главной страницы', 'Ключи главной страницы');
    }
}