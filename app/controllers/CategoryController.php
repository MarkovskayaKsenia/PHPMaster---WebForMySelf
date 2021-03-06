<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use app\widgets\filter\Filter;
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
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = App::$app->getProperty('pagination');

        $sql_part = '';
        if (!empty($_GET['filter'])) {
            $filter = Filter::getFilter();
            if ($filter) {
                $count_groups = Filter::getCountGroups($filter);
                $sql_part = "AND id IN (SELECT product_id FROM attribute_product WHERE attr_id IN($filter) GROUP BY product_id HAVING COUNT(product_id) = $count_groups)";
            }

        }

        $total = \R::count('product', "category_id IN ($ids) $sql_part");
        $pagination = new Pagination($page, $perPage, $total);
        $start = $pagination->getStart();

        $products = \R::find('product', "category_id IN ($ids) $sql_part LIMIT $start, $perPage");

        if ($this->isAjax()) {
            $this->loadView('filter', compact('products', 'total', 'pagination'));
        }

        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->set(compact('products', 'breadcrumbs', 'pagination', 'total'));
    }
}