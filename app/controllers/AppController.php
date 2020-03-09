<?php


namespace app\controllers;


use app\models\AppModel;
use app\widgets\currency\Currency;
use ishop\App;
use ishop\base\Controller;
use ishop\Cache;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        $currency = Currency::getCurrencies();
        App::$app->setProperty('currencies', Currency::getCurrencies());
        App::$app->setProperty('currency', Currency::getCurrency(App::$app->getProperty('currencies')));
        App::$app->setProperty('categories', self::cacheCategory());
    }

    public static function cacheCategory()
    {
        $cache = Cache::instance();
        $categories = $cache->get('categories');
        if (!$categories) {
            $categories = \R::getAssoc("SELECT * FROM category");
            $cache->set('categories', $categories);
        }
        return $categories;
    }
}