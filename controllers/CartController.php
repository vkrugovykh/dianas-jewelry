<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 27.01.2019
 * Time: 1:01
 */

namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Products;
use Yii;
use yii\web\Controller;

class CartController extends Controller
{

    public function actionOrder() {
        $session = Yii::$app->session;
        $session->open();

        if (!$session['cart.totalSum'] && !$session['currentId']) {
            return Yii::$app->response->redirect(Url::to('/'));
        } else if (!$session['cart.totalSum'] && $session['currentId']) {
            return $this->render('success', compact('session'));
        }

        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->date = date('Y-m-d H:i:s');
            $order->sum = $session['cart.totalSum'];
            if ($order->save()) {
                $currentId = $order->id;

                $this->saveOrderInfo($session['cart'], $currentId);

                //Отправка письма о заказе покупателю
                Yii::$app->mailer->compose('order-mail', ['session'=>$session, 'order'=>$order])
                    ->setFrom(['phpshop2019@gmail.com' => 'Dianas jewelry'])
                    ->setTo($order->email)
                    ->setSubject('Ваш заказ принят')
                    ->send();

                //Отправка письма о заказе администратору
                Yii::$app->mailer->compose('admin-order-mail', ['session'=>$session, 'order'=>$order])
                    ->setFrom(['phpshop2019@gmail.com' => 'Dianas jewelry'])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Новый заказ!')
                    ->send();

                $session->set('lastOrderName', $order->name);
                $session->set('lastOrderEmail', $order->email);
                $session->set('lastOrderPhone', $order->phone);
                $session->set('lastOrderAddress', $order->address);
                $session->set('lastOrderOrderItems', $session['cart']);
                $session->set('lastOrderTotalQuantity', $session['cart.totalQuantity']);
                $session->set('lastOrderTotalSum', $session['cart.totalSum']);

                $session->remove('cart');
                $session->remove('cart.totalQuantity');
                $session->remove('cart.totalSum');
                $session->set('currentId', $currentId);
//                return $this->render('success', compact('session', 'currentId'));
                return $this->render('success', compact('session'));
            }
        }
        $this->layout = 'cart-layout';
        return $this->render('cart', compact('session', 'order'));
    }

    protected function saveOrderInfo($products, $orderId)
    {

        foreach ($products as $id=>$product) {
//            var_dump($product);die;
            $orderInfo = new OrderProduct();
            $orderInfo->order_id = $orderId;
            $orderInfo->product_id = $id;
            $orderInfo->name = $product['name'];
            $orderInfo->price = $product['price'];
            $orderInfo->quantity = $product['productQuantity'];
            $orderInfo->sum = $product['price'] * $product['productQuantity'];
            $orderInfo->save();
        }
    }

    public function actionDelete($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalcCart($id);
        $order = new Order();
        return $this->renderPartial('cart', compact('session', 'order'));
    }

    public function actionChange($id, $qnt)
    {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->changeInCart($id, $qnt);
        $order = new Order();
        return $this->renderPartial('cart', compact('session', 'order'));
    }


    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.totalQuantity');
        $session->remove('cart.totalSum');
        return $this->renderPartial('cart', compact('session'));
    }

    public function actionOpen()
    {
        $session = Yii::$app->session;
        $session->open();
        $order = new Order();
        $this->layout = 'cart-layout';
        return $this->render('cart', compact('session', 'order'));
    }

    public function actionAdd($alias, $qnt)
    {
        $product = new Products();
        $product = $product->getOneProduct($alias);
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qnt);

        return $session['cart.totalQuantity'] . '/' . number_format($session['cart.totalSum'], 2, '.', ' ');
    }
}