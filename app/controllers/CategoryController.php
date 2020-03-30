<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use ishop\App;
use ishop\libs\Pagination;


class CategoryController extends AppController
{
    public function viewAction()
    {

        $alias = $this->route['alias'];
        $category = \R::findOne('category', 'alias = ?', [$alias]);
        if (!$category) {
            throw new \Exception('Страница не найдена', 404);
        }


        //хлебные крошки
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);

        $category_model = new Category();
        $ids = $category_model->getIds($category->id);
        $ids = ($ids === null) ? $category->id : $ids . $category->id;



        //Пагинация
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perPage = App::$app->getProperty('pagination');
        $total = \R::count('product', "category_id IN ($ids)");
        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();

        $products = \R::find('product', "category_id IN ($ids) LIMIT $start, $perPage");
        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->set(compact('products', 'breadcrumbs', 'pagination', 'total'));
    }
}