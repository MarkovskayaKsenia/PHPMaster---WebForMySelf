<?php


namespace app\controllers\admin;


use ishop\Cache;

class CacheController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Очистка кэша');
    }

    public function deleteAction()
    {
        $key = $_GET['key'] ?? null;
        $cache = Cache::instance();

        switch ($key) {
            case 'category':
                $cache->delete('categories');
                $cache->delete('ishop_menu');
                break;
            case 'filter':
                $cache->delete('filter_attributes');
                $cache->delete('filter_group');
                break;
        }

        $_SESSION['success'] = 'Выбрвнный кэш удален';
        redirect();
    }
}