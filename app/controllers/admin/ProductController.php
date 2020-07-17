<?php


namespace app\controllers\admin;


use app\models\admin\Product;
use app\models\AppModel;
use ishop\App;
use ishop\libs\Pagination;

class ProductController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $perpage= 5;
        $total = \R::count('product');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $products = \R::getAll("SELECT product.*, category.title AS category FROM product 
    JOIN category on product.category_id = category.id ORDER BY product.title LIMIT $start, $perpage");
        $this->setMeta('Список товаров');
        $this->set(compact('products', 'pagination', 'total'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            $product = new Product();
            $data = $_POST;

            $product->load($data);
            $product->attributes['status'] = $product->attributes['status'] ? 'active' : 'unactive';
            $product->attributes['hit'] = $product->attributes['hit'] ? 'hit' : 'common';

            if (!$product->validate($data)) {
                $product->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }


            if ($id = $product->save('product')) {
                $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
                $product_load = \R::load('product', $id);
                $product_load->alias = $alias;
                \R::store($product_load);
                $product->editFilter($id, $data);
                $product->editRelatedProduct($id, $data);
                $_SESSION['success'] = 'Товар добавлен';
                redirect();
            }
        }
        $this->setMeta('Новый товар');
    }

    public function relatedProductAction()
    {
        /*$data = [
            'items' => [
               [
                'id' => 1,
                'text' => 'Товар 1',
               ],
               [
                'id' => 2,
                'text' => 'Товар 2',
                ],
              ]
          ]; */

        $q = ($_GET['q']) ?? '';
        $data['items'] = [];
        $products = \R::getAssoc('SELECT id, title FROM product WHERE title LIKE ? LIMIT 10', ["%{$q}%"]);
        if ($products) {
            $i = 0;
            foreach ($products as $id => $title) {
                $data['items'][$i]['id'] = $id;
                $data['items'][$i]['text'] = $title;
                $i++;
            }
        }
        echo json_encode($data);
        exit();
    }

    public function addImageAction()
    {
        if (isset($_GET['upload'])) {
            if ($_POST['name'] === 'single') {
                $max_width = App::$app->getProperty('img_width');
                $max_height = App::$app->getProperty('img_height');
            } else {
                $max_width = App::$app->getProperty('gallery_width');
                $max_height = App::$app->getProperty('gallery_height');
            }

            $name = $_POST['name'];
            $product = new Product();
            $product->uploadImg($name, $max_width, $max_height);
        }
    }


}