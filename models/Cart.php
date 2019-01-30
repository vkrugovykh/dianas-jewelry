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
    public function addToCart($product, $qnt = 1)
    {
        if (isset($_SESSION['cart'][$product->id])) {
            if ($qnt + $_SESSION['cart'][$product->id]['productQuantity'] <= 5) {
                $productsQnt = $qnt;
            } else if ($qnt + $_SESSION['cart'][$product->id]['productQuantity'] > 5) {
                $productsQnt = 5 - $_SESSION['cart'][$product->id]['productQuantity'];
            }
            $_SESSION['cart'][$product->id]['productQuantity'] += $productsQnt;

            $_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity']) ? $_SESSION['cart.totalQuantity'] + $productsQnt : $productsQnt;
            $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum']) ? $_SESSION['cart.totalSum'] + $product->getProductPromo($product->alias) * $productsQnt : $product->getProductPromo($product->alias) * $productsQnt;

//            else {
//                $_SESSION['cart'][$product->id]['productQuantity'] = 5;
//            }

        } else {
            $productsQnt = $qnt;
            $_SESSION['cart'][$product->id] = [
                'productQuantity' => $productsQnt,
                'name' => $product['name'],
                'short_description' => $product['short_description'],
                'price' => $product->getProductPromo($product['alias']),
//                'price' => $product['price'],
                'img' => $product['img'],
                'alias' => $product['alias'],
            ];

            $_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity']) ? $_SESSION['cart.totalQuantity'] + $productsQnt : $productsQnt;
            $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum']) ? $_SESSION['cart.totalSum'] + $product->getProductPromo($product->alias) * $productsQnt : $product->getProductPromo($product->alias) * $productsQnt;
        }

        //$_SESSION['cart.totalQuantity'] = isset($_SESSION['cart.totalQuantity']) ? $_SESSION['cart.totalQuantity'] + 1 : 1;

//        $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum']) ? $_SESSION['cart.totalSum'] + $product->getProductPromo($product->alias) * $productsQnt : $product->getProductPromo($product->alias) * $productsQnt;
//        $_SESSION['cart.totalSum'] = isset($_SESSION['cart.totalSum']) ? $_SESSION['cart.totalSum'] + $product->price : $product->price;
    }

    public function recalcCart($id)
    {
        $quantity = $_SESSION['cart'][$id]['productQuantity'];
        $price = $_SESSION['cart'][$id]['price'] * $quantity;
        $_SESSION['cart.totalQuantity'] -= $quantity;
        $_SESSION['cart.totalSum'] -= $price;
        unset($_SESSION['cart'][$id]);
    }

    public function changeInCart($id, $qnt) {
        $quantity = $_SESSION['cart'][$id]['productQuantity'];
        $subtraction = $qnt - $quantity;
        $_SESSION['cart'][$id]['productQuantity'] += $subtraction;

        $_SESSION['cart.totalQuantity'] += $subtraction;

        $_SESSION['cart.totalSum'] += ($subtraction * $_SESSION['cart'][$id]['price']);
    }
}