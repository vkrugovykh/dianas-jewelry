<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 26.01.2019
 * Time: 23:56
 */

namespace app\controllers;

use app\models\Products;
use app\models\Returns;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex($alias)
    {
        $product = new Products();
        $product = $product->getOneProduct($alias);

        $returns = new Returns();
        $returns = $returns->getOneReturn($product['returns_id']);
        return $this->render('index', compact('product', 'returns'));
    }
}