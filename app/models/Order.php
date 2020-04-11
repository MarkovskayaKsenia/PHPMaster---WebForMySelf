<?php


namespace app\models;


use ishop\App;

class Order extends AppModel
{
    public $attributes = [
        'user_id' => '',
        'currency' => '',
        'note' => '',
        'status' => '1',
    ];

    public function saveOrder($data)
    {
        $this->load($data);
        \R::begin();
        try {
            $order_id = $this->save('order');
            $this->saveOrderProduct($order_id);
            \R::commit();
            return $order_id;
        } catch (\Exception $e) {
            \R::rollback();
        }
    }

    public function saveOrderProduct($order_id)
    {
        $sql_part = '';
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $product_id = (int)$product_id;
            $sql_part .= "($order_id, $product_id, {$product['qty']}, '{$product['title']}', {$product['price']}),";
        }
        $sql_part = rtrim($sql_part, ',');
        \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price) VALUES {$sql_part}");

    }

    public function mailOrder($order_id, $user_email)
    {
        //Create Transport
        $transport = (new \Swift_SmtpTransport(
            App::$app->getProperty('smtp_host'),
            App::$app->getProperty('smtp_port')))
            ->setUsername(App::$app->getProperty('smtp_username'))
            ->setPassword(App::$app->getProperty('smtp_password'));

        //Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        //Create a message
        ob_start();
        require APP . '/views/mail/mail_order.php';
        $body = ob_get_clean();

        $message_client = (new \Swift_Message("Оформлен заказ № {$order_id} на сайте \"" . App::$app->getProperty('shop_name') . "\""))
            ->setFrom([App::$app->getProperty('smtp_from') => App::$app->getProperty('shop_name')])
            ->setTo([$user_email, App::$app->getProperty('admin_email')])
            ->setBody($body, 'text/html');

        $result_send_mail = $mailer->send($message_client);

        if ($result_send_mail) {
            unset($_SESSION['cart']);
            unset($_SESSION['cart.qty']);
            unset($_SESSION['cart.sum']);
            unset($_SESSION['cart.currency']);
            $_SESSION['success'] = 'Спасибо за заказ, наш менеджер свяжется с вами в ближайшее время.';
        }

    }
}