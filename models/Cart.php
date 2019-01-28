<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 27.01.2019
 * Time: 0:43
 */

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{
    public function addToCart($product)
    {
        if (isset($_SESSION['cart'][$product->id])) {
            if ($_SESSION['cart'][$product->id]['productQuantity'] < 5) {
                $_SESSION['cart'][$product->id]['productQuantity'] += 1;
                $_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity']) ? $_SESSION['cart.totalQuantity'] + 1 : 1;
            } else {
                $_SESSION['cart'][$product->id]['productQuantity'] = 5;
            }

        } else {
            $_SESSION['cart'][$product->id] = [
                'productQuantity' => 1,
                'name' => $product['name'],
                'short_description' => $product['short_description'],
                'price' => $product['price'],
                'img' => $product['img'],
            ];
            $_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity']) ? $_SESSION['cart.totalQuantity'] + 1 : 1;
        }

        //$_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity']) ? $_SESSION['cart.totalQuantity'] + 1 : 1;

        $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum']) ? $_SESSION['cart.totalSum'] + $product->price : $product->price;
    }

    public function recalcCart($id)
    {
        $quantity = $_SESSION['cart'][$id]['productQuantity'];
        $price = $_SESSION['cart'][$id]['price'] * $quantity;
        $_SESSION['cart.totalQuantity'] -= $quantity;
        $_SESSION['cart.totalSum'] -= $price;
        unset($_SESSION['cart'][$id]);
    }

}